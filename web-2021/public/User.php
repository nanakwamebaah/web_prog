<?php
include "init.php";
//require_once("Database.php");
class User{
    protected $db;

    public function __construct()
    {
        $this->db = Database::instance();
    }



    public function emailExists($email){
        $stmt = $this->db->prepare("SELECT * FROM `Users` WHERE `email`= :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function hash($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
    // login user
    public function login($user, $pass){
        if($stmt = $this->db->prepare("SELECT `username`,`email`,`password` FROM `Users` WHERE `email`= :email OR `username`= :user")){
            $stmt->bindParam(":email", $user);
            $stmt->bindParam(":user", $user);
            $stmt->execute();
            $info=$stmt->fetch(PDO::FETCH_ASSOC);
            //$stmt->store_result();
            if ($info){
                if (password_verify($pass,$info['password'])){
                    $_SESSION['username'] = $info['username'];
                    $_SESSION['email'] = $info['email'];
                    $_SESSION['userLoginStatus'] = 1;
                    return 1;
                }else{
                    return 'Wrong password';
                }
            } else{
                return  'Wrong username or email';
            }
        }
    }
    //register user
    public function register($uname, $email, $pass, $fname, $lname){
        $passH = $this->hash($pass);
        $stmt = $this->db->prepare("INSERT INTO `Users` (`username`, `email`, `password`, `firstname`, `surname`) VALUES(:username, :email, :password, :firstname, :surname)");
        $stmt->bindParam(":username", $uname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $passH);
        $stmt->bindParam(":firstname", $fname);
        $stmt->bindParam(":surname", $lname);
        
        if ($stmt->execute()){
            return true;
        }else{
            return $stmt->error;
        }
    }
    
    public function generatePass($length){
        $chars = "vwxyzABCD02789#@";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length){
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
    
    public function logout(){
        session_start();
        $_SESSION = array();
        session_destroy();
    }

    public function isLoggedIn(){
        if(isset($_SESSION['userLoginStatus'])){
            return true;
        }else{
            return false;
        }

    }
    public function read(){
        $stmt=$this->db->prepare("SELECT `username`,`email`,`password`,`firstname`, `surname` FROM `Users` ORDER BY userId ");
        $stmt->execute();
        return $stmt;

    }
    public function read_1($id){
        $stmt=$this->db->prepare("SELECT `username`,`email`,`password`,`firstname`, `surname` FROM `Users` WHERE `userId` =  :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        //$row = $stmt->fetch(PDO::FETCH_ASSOC)
       
        return $stmt;

    }

    public function insertData($data){
        $info = $this->emailExists($data["email"]);
        if(!$info["userId"]){
            //sign up
            $insertNewUser = $this->db->prepare("INSERT INTO `Users` (`username`, `email`, `password`, `firstname`, `surname`) VALUES(:username, :email, :password, :firstname, :surname)");
            $insertNewUser->execute([
                ':username'  => NULL,
                ':email'     => $data["email"],
                ':password'  => $this->hash($this->generatePass(6)),
                ':firstname' => $data["firstname"],
                ':surname'   => $data["surname"]
            ]);
            if($insertNewUser){
                //setcookie("id", $db->lastinsertId(), time()+60*60*60*24*30, "/", NULL);
                // go straight to your home page
                $_SESSION['userLoginStatus'] = 1;
                header('Location:http://localhost:8080/index1.html' );
                exit();
            }else{
                return "Error signing up user";
            }
        }else{
            //if user exist send him to his homepage
            $_SESSION['userLoginStatus'] = 1;
            header('Location:http://localhost:8080/index1.html');
        }

    }
}
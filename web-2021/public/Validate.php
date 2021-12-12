<?php

class Validate{
    public function __construct()
    {
        $this->db = Database::instance();
    }

    public static function escape($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlentities($input, ENT_QUOTES);
        return $input;
    }

    public static function filterEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public function usernameValidate($uname){
        if (empty($uname)){
            return 'Username is blank';
        }elseif(strlen($uname) < 2){
            return 'Username is too short';
        }elseif(strlen($uname) > 64){
            return 'Username is too long';
        }/*elseif(!preg_match('/^[a-z]{2,64}$/i', $uname)){
            return 'Username cannot include special characters';
        }*/else{
            $uname = strip_tags($uname);
            $stmt = $this->db->prepare("SELECT `username` FROM `Users` WHERE `username`= :username");
            $stmt->bindParam(':username', $uname);
            $stmt->execute();
            $info=$stmt->fetch(PDO::FETCH_ASSOC);
            
            //If duplicate username, throw error, else return username
            if ($info['username'] === $uname) {
                return 'Username is already taken';        
            }
        }
        
    }
    public function passwordValidate($pass, $pass2){
        if (empty($pass) || empty($pass2)){
            return 'Password is blank';
        } elseif(strlen($pass) < 6){
            return 'Password is too short';
        }elseif($pass !== $pass2){
            return 'Password do not match';
        }
    }
    public function emailValidate($email){
        if(empty($email)){
            return 'Email is blank';
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'Invalid email';
        }else{
            $email = strip_tags($email);
            $stmt = $this->db->prepare("SELECT `email` FROM `Users` WHERE `email` = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR );
            $stmt->execute();
            $info=$stmt->fetch(PDO::FETCH_ASSOC);
            
            //If duplicate email, throw error, else return email
            if ($info['email'] === $email) {
                return 'Email is already in use';
        }
    }
   }
   /* public functon myclass(){
        return
    }*/
}
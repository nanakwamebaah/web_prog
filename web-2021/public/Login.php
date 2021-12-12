<?php

session_start();
require_once('init.php');
require_once('User.php');
require_once('config.php');
require_once('Validate.php');

$user = new User;
$validate = new Validate;
$errors = array();

if(isset($_POST['login'])){
    $uname = $_POST['user'];
    $pass  = $_POST['passwd'];

    if(empty($uname)){
        $errors[] = 'Please enter username or email';
    }
    if(empty($pass)){
        $errors[] = 'Please enter password';
    }
    if(empty($errors)){
        if($user->login($uname, $pass) == 1){
            header("Location:http://localhost:8080/index1.html");
        }else{
            $info = $user->login($uname, $pass);
            echo $info;
        }
    }else{
        foreach($errors as $error){
            printf ($error . "<br/>");
          }
    }
}
if(isset($_POST['loginGoogle'])){
    header("Location: " .filter_var($login_url, FILTER_SANITIZE_URL));
}

?>
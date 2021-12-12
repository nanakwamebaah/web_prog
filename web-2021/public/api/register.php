<?php

header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
include "../init.php"; 
require_once('../config.php');
require_once "../config.php";
require_once "../User.php";
require_once('../Validate.php');

$user = new User;
$validate = new Validate;
$errors = array();

/*$uname = $_POST['user'];
$email = $_POST['email'];
$pass  = $_POST['passwd'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pass2 = $_POST['re_passwd'];*/

$uname = $_GET['user'];
$email = $_GET['email'];
$pass  = $_GET['passwd'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$pass2 = $_GET['re_passwd'];

if(isset($uname) & isset($email) & isset($pass) & isset($fname) & isset($lname) & isset($pass2)){
    $uname = $_GET['user'];
    $email = $_GET['email'];
    $pass  = $_GET['passwd'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $pass2 = $_GET['re_passwd'];

    //$register = $user->register($uname, $email, $pass, $fname, $lname);
    if ($validate->usernameValidate($uname) != null){
      $errors[] = $validate->usernameValidate($uname);
    }
    if ($validate->emailValidate($email) != null){
      $errors[] = $validate->emailValidate($email);
    }
    if ($validate->passwordValidate($pass, $pass2) != null){
      $errors[] = $validate->passwordValidate($pass, $pass2);
    }
    if(empty($errors)){
      if($user->register($uname, $email, $pass, $fname, $lname) === true){
        echo 'successfull sign up';
      }else{
            echo 'Error signing up. please try again';
      }
    }else{
           
      foreach($errors as $error){
        printf($error . "<br/>");
      }
    }
}

/*if(isset($_POST['loginGoogle'])){
    header("Location: " .filter_var($login_url, FILTER_SANITIZE_URL));
}*/
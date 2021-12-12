
<?php

require_once('init.php');
require_once('User.php');
require_once('config.php');
require_once('Validate.php');

$user = new User;
$validate = new Validate;
$errors = array();

if(isset($_POST['register'])){
    $uname = $_POST['user'];
    $email = $_POST['email'];
    $pass  = $_POST['passwd'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pass2 = $_POST['re_passwd'];

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
if(isset($_POST['loginGoogle'])){
    header("Location: " .filter_var($login_url, FILTER_SANITIZE_URL));
}

?>
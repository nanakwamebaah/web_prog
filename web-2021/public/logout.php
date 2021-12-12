<?php

require_once('init.php');
require_once('User.php');
require_once('Validate.php');

$user = new User;
if(isset($_POST['logout'])){
      $user->logout();
      header("Location: http://localhost:8080/" );
}
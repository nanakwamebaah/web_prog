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

if(isset($_GET['username']) && isset($_GET['password'])){
    $uname = $_GET['username'];
    $pass = $_GET['password'];
    //echo $pass;
    //$_POST['password'];
    if($user->login($uname, $pass) == 1){
        echo json_encode(array('message'=>'success'));
        
    }else{
        $info = $user->login($uname, $pass);
        echo json_encode(array('message'=>$info));
    }
}
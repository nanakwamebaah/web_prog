<?php

header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
include "init.php"; 
require_once('config.php');
require_once "config.php";
require_once "User.php";
require_once('Validate.php');

$user = new User;
$validate = new Validate;
$errors = array();

/*$result = $user->read();
$num = $result->rowCount();

if ($num > 0){
    $post_arr = array();
    $post_arr['data'] = array();
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            ':username'  => $username,
            ':email'     => $email,
            //':password'  => $password,
            ':firstname' => $firstname,
            ':surname'   => $surname
        );
        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
}else{
    echo json_encode(array('message'=>'No posts found'));
}*/
/*
//login
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
}*/

/*
//read_1
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $user->read_1($id);
    $num = $result->rowCount();

    if ($num > 0){
        $post_arr = array();
        $post_arr['data'] = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $post_item = array(
                ':username'  => $username,
                ':email'     => $email,
                //':password'  => $password,
                ':firstname' => $firstname,
                ':surname'   => $surname
            );
            array_push($post_arr['data'], $post_item);
        }
        echo json_encode($post_arr);
    }else{
        echo json_encode(array('message'=>'No posts found'));
    }
}*/

//register

//require_once("config/dbconnect.php");

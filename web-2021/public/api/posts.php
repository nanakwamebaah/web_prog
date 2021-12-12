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
}
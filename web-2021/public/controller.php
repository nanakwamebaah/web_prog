<?php
require_once "config.php";
require_once "User.php";


if(isset($_GET["code"])){
    $token = $g_client->fetchAccessTokenWithAuthCode($_GET["code"]);
}else{
    header('Location: index.php');
    exit();
}
if(isset($token["error"]) != "Invalid_grant"){
    //get data from google
    $oAuth = new Google_Service_Oauth2($g_client);
    $userData = $oAuth->userinfo->get();
    $User = new User;
    $User->insertData(array(
        "email"     => $userData["email"],
        "firstname" => $userData["givenName"],
        "surname"   => $userData["familyName"]
    ));
    //var_dump($userData);
}else{
    header('Location:http://localhost:8080/');
    exit();
}
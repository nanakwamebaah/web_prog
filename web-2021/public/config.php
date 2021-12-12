<?php
require_once('google-api/vendor/autoload.php');

$g_client = new Google_Client();

$g_client->setClientId("173799441506-tspo35a9ao4cdgl5eda6bqsm86lkq8ml.apps.googleusercontent.com");
$g_client->setClientSecret("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");
$g_client->setRedirectUri("http://localhost:8080/controller.php");
$g_client->addScope('email');
$g_client->addScope('profile');
 
//login url
$login_url = $g_client->createAuthUrl();
?>
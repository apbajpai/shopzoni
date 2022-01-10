<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = 'Google Project Client ID'; //Google CLIENT ID
$clientSecret = 'Google Project Client Secret'; //Google CLIENT SECRET
$redirectUrl = 'http://localhost/login-with-google-using-php';  //return url (url to script)
$homeUrl = 'http://localhost/login-with-google-using-php';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to codexworld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
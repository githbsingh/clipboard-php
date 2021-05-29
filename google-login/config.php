<?php
/*
 * Basic Site Settings and API Configuration
 */
require_once "../config.php";

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
//require_once 'google-api-php-client/src/Client.php';
//require_once 'google-api-php-client/src/Service.php';
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('clipboard');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);
//Adding Scope
$gClient->addScope('email');
$gClient->addScope('profile');

$google_oauthV2 = new Google_Service_Oauth2($gClient);


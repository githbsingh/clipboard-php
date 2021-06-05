<?php

// Database configuration
define('DB_HOST', $_SERVER['DB_HOST']);
define('DB_USERNAME', $_SERVER['DB_USERNAME']);
define('DB_PASSWORD', $_SERVER['DB_PASSWORD']);
define('DB_NAME', $_SERVER['DB_NAME']);
define('DB_USER_TBL', $_SERVER['DB_USER_TBL']);

//define('BASE_URL', 'https://frozen-sierra-06530.herokuapp.com/');
define('BASE_URL', $_SERVER['BASE_URL']);
// Google API configuration
define('GOOGLE_CLIENT_ID', $_SERVER['GOOGLE_CLIENT_ID']);
define('GOOGLE_CLIENT_SECRET', $_SERVER['GOOGLE_CLIENT_SECRET']);
define('GOOGLE_REDIRECT_URL', $_SERVER['GOOGLE_REDIRECT_URL']);


// Facebook API configuration

define('FB_APP_ID', $_SERVER['FB_APP_ID']);
define('FB_APP_SECRET', $_SERVER['FB_APP_SECRET']);
define('FB_REDIRECT_URL', $_SERVER['FB_REDIRECT_URL']);


// Twitter API configuration 
define('TW_CONSUMER_KEY', $_SERVER['TW_CONSUMER_KEY']); 
define('TW_CONSUMER_SECRET', $_SERVER['TW_CONSUMER_SECRET']); 
define('TW_REDIRECT_URL', $_SERVER['TW_REDIRECT_URL']); 

//Aws S3 configuration 

define('AWS_S3_KEY', $_SERVER['AWS_S3_KEY']);
define('AWS_S3_SECRET', $_SERVER['AWS_S3_SECRET']);
define('AWS_S3_REGION', $_SERVER['AWS_S3_REGION']);
define('AWS_S3_BUCKET', $_SERVER['AWS_S3_BUCKET']);
define('AWS_S3_URL', $_SERVER['AWS_S3_URL']);



// Start session
if(!session_id()){
    session_start();
}
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<?php 
/* 
 * Basic Site Settings and API Configuration 
 */ 
 
// Database configuration
define('DB_HOST', 'ranchinow.com');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'clipboard');
define('DB_USER_TBL', 'users');

// Twitter API configuration 
define('TW_CONSUMER_KEY', 'qmkVKcZsx64qs2jLocadXa9b4'); 
define('TW_CONSUMER_SECRET', '3MXlFzsLosOitwUzujupoDyjMEZnRei59n7hJVupqHCB4y6b88'); 
define('TW_REDIRECT_URL', 'https://frozen-sierra-06530.herokuapp.com//twitter-login/'); 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include Twitter client library  
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
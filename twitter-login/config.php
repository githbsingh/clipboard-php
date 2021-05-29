<?php 
/* 
 * Basic Site Settings and API Configuration 
 */ 
 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'clipboard'); 
define('DB_USER_TBL', 'users'); 
 
// Twitter API configuration 
define('TW_CONSUMER_KEY', 'evmBpUznqpVpZFCathN4yEKyU'); 
define('TW_CONSUMER_SECRET', 'l4HKsZteIK3humJQxo27xwLUYYx4srwN4WbjZjHLgCYBSimKT8'); 
define('TW_REDIRECT_URL', 'http://localhost/clipboard/twitter-login/'); 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include Twitter client library  
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
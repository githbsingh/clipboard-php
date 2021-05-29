<?php

// Database configuration
define('DB_HOST', 'ranchinow.com');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'clipboard');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '675155176476-0fjf5lrv7eb7vfccdiif8ae5tg8uef26.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '9rosAU-vXt4YsXRokyPR7hAV');
define('GOOGLE_REDIRECT_URL', 'https://frozen-sierra-06530.herokuapp.com/google-login/');


// Facebook API configuration

define('FB_APP_ID', '1884183495069774');
define('FB_APP_SECRET', 'e16cf3acd3e01e274d860b24dccab8e8');

define('FB_REDIRECT_URL', 'https://frozen-sierra-06530.herokuapp.com/facebook-login/');



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
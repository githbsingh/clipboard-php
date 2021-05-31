<?php 
/* 
 * Basic Site Settings and API Configuration 
 */ 
require_once "../config.php";
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include Twitter client library  
//require "vendor/autoload.php";

//use Abraham\TwitterOAuth\TwitterOAuth;
//require_once 'twitteroauth/twitteroauth.php';
require_once 'twitteroauth/OAuth.php';
require_once 'twitteroauth/twitteroauth.php';
<?php
// Include configuration file
require_once 'config.php';
// Reset OAuth access token
$gClient->revokeToken($_SESSION['token']);


// Remove token and user data from the session
unset($_SESSION['token']);
unset($_SESSION['userData']);


// Destroy entire session data
session_destroy();

// Redirect to homepage
header("Location:index.php");
?>
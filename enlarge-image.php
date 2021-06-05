<?php
// Start session
if(!session_id()){
    session_start();
}
if(!$_SESSION["loggedin"] == true){

    // Redirect user to welcome page
    header("location: login");
}
$image_url="https://clipboard-uploads-dev.s3.us-east-1.amazonaws.com/".$_GET['image'];

?>
<!DOCTYPE html>
<html>
<head>
<title>Clipboard</title>
  <!-- add icon link -->
  <link rel = "icon" href ="img/clipboard-flat.png"  type = "image/x-icon">
<style>
body {
	
	  /*background: #63738a;*/
    
    background-image: url("<?=$image_url?>");
    height: 100%; /* You must set a specified height */
   /* background-position: center;  Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover;
    background-color:  #f8f9fa;
}
</style>
</head>
<body>

</body>
</html>
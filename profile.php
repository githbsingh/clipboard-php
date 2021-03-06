<?php 

require_once "config.php";
if($_SESSION['loggedin']){

  $db = $link;  
  // Check whether the user already exists in the database  
  $checkQuery = "SELECT * FROM users WHERE id = ".$_SESSION['id'];  
  // $_SESSION["twitter"]=$data;
   $checkResult = $db->query($checkQuery);  
     
    // Get user data from the database  
   
  
    while ($userData = $checkResult->fetch_assoc()) {
      $user_name   = $userData["first_name"].' '.$userData["last_name"];
      $user_email   = $userData["email"];
      $user_image   = ($userData["picture"]==null?"img/user-icon.png":$userData["picture"]);
      $user_account_type   = $userData["oauth_provider"];
      //$user_image ="img/user-icon.png";
    }       
    
}else{

    header("Location: ../login");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cloudupp</title>
    <!-- add icon link -->
    <link rel = "icon" href ="img/clipboard-flat.png"  type = "image/x-icon">
	<link rel="stylesheet" href="css/main.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style type="text/css">
      
      
    footer{
       /* position:absolute;bottom:0px;*/
        margin-left: 38%;
        margin-right: 38%;
        margin-top:100px
        
    }
  
        .form-group {
            margin: 25px 35px !important;
        }
        .label-title {
            font-weight: bold;
        }
    </style>

</head>
<body>
    <div class="row" style="margin-top:40px;">
    
        <!--<img src="img/clipboard-flat.png" style="margin-left:50px;width:70px"/>
        <h1 style="margin-top:14px;">Clipboard</h1>-->
        <div style="margin:auto;"><img src="img/clipboard-flat.png" style="margin-left:18px;" width="100" height="100" class="d-inline-block align-top" alt=""> 
        <h2 style="color:white;">Cloudupp</h2>
        </div>
        
    </div>

	<form action="enter-email" method="post">
        <div class="row"><img src="<?=$user_image ?>" style="margin:auto;" width="100" height="100" class="d-inline-block align-top" alt=""> </div>
		<h2 class="form-title"><?=$user_name ?></h2>
		<!-- form validation messages
		<?php include('messages.php'); ?> 
		<div class="form-group">
			<label>Your email address</label>
			<input type="email" name="email">
		</div>-->
        <div class="form-group">
            <div class="col-6">  
            <label class="label-title">Email</label> 
            
            <label ><?=$user_email ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-6"> 
            <label class="label-title">Account Type</label>  
            
            <label ><?=$user_account_type ?></label>
            </div>
            
        </div>
       		
        
        <p class="text-center text-muted "><a href="index">Back to Home</a></p>
	</form>
    <footer class="page-footer font-small" ><div class="footer-copyright text-center"><p style="color: white;font-weight: 100;mix-blend-mode: difference;">&copy; Cloudupp <?= date("Y")?>. All Rights Reserved</p></div></footer>
    
</body>
</html>
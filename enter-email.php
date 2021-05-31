<?php include('logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clipboard</title>
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
    </style>

</head>
<body>
    <div class="row" style="margin-top:40px;">
    
        <!--<img src="img/clipboard-flat.png" style="margin-left:50px;width:70px"/>
        <h1 style="margin-top:14px;">Clipboard</h1>-->
        <div style="margin:auto;"><img src="img/clipboard-flat.png" style="margin-left:18px;" width="100" height="100" class="d-inline-block align-top" alt=""> 
        <h2 style="color:white;">Clipboard</h2>
        </div>
        
    </div>

	<form action="enter-email.php" method="post">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages
		<?php include('messages.php'); ?> 
		<div class="form-group">
			<label>Your email address</label>
			<input type="email" name="email">
		</div>-->
        <div class="form-group">
            <div class="input-group">    
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-at"></span>
                        </span>                    
                    </div>
                <input type="email" class="form-control" name="email" placeholder="email" required="required">
            </div>
        </div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="btn btn-primary">Submit</button>
		</div>
        
        <p class="text-center text-muted "><a href="login.php">Back to Login</a></p>
	</form>
    <footer class="page-footer font-small" ><div class="footer-copyright" style="text-align: center;"><p >&copy; Clipbaord <?= date("Y")?>. All Rights Reserved</p></div></footer>
</body>
</html>
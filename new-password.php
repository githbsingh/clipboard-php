<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="css/main.css">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<form class="login-form" action="new-password.php" method="post">
		<h2 class="form-title">New password</h2>
		<!-- form validation messages
		<?php include('messages.php'); ?> 
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c">
		</div>-->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="new_pass" placeholder="New Password" required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="new_pass_c" placeholder="Confirm new password" required="required">
            </div>
        </div>
		<div class="form-group">
			<button type="submit" name="new_password" class="btn btn-primary">Submit</button>
		</div>
	</form>
</body>
</html>
<?php include('logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clipboard</title>
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
	<form class="login-form" action="enter-email.php" method="post">
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
        
        <p class="text-center text-muted small"><a href="login.php">Cancel</a></p>
	</form>
    
</body>
</html>
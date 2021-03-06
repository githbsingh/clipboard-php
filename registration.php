<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    //} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["email"]))){
    
    //    $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already exist.";                    
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
       // echo "Preparing to insert user info in DB";
        $param_current_date = date("Y-m-d H:i:s"); 
        $param_oauth_provider = 'email';
        $param_first_name =$_POST["first_name"];
        $param_last_name = $_POST["last_name"];
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (oauth_provider, first_name, last_name, email, password,created) VALUES (?,?,?,?,?,?)";
        
        //$sql = "INSERT INTO users (oauth_provider, first_name, last_name, email, password,created) VALUES ('email','$param_first_name','$param_last_name', '$email','$param_password','$param_current_date')";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"ssssss", $param_oauth_provider,$param_first_name,$param_last_name, $param_email, $param_password,$param_current_date);
            //echo "Preparing to insert user info in DB";
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
   
    }else{

        echo $email_err.'br'.$password_err.'br'.$confirm_password_err;      

    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Cloudupp</title>
<!-- add icon link -->
<link rel = "icon" href ="img/clipboard-flat.png"  type = "image/x-icon">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	
	background: #63738a;

    background-image: url("img/pexels-andrew-neel-2312369.jpg");
    height: 100%; /* You must set a specified height */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover;
}

    footer{
       /* position:absolute;bottom:0px;*/
        margin-left: 38%;
        margin-right: 38%;
        margin-top:100px
        
    }



</style>
<style type="text/css">
.reg-form {
    width: 400px;
    margin: 30px auto;
}
.reg-form form {        
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.reg-form h2 {
    margin: 0 0 15px;
}
.form-control, .login-btn {
    border-radius: 2px;
}
.input-group-prepend .fa {
    font-size: 18px;
}
.login-btn {
    font-size: 15px;
    font-weight: bold;
  	min-height: 40px;
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
<div class="reg-form">
    <form action="registration" method="post">
        <h2 class="text-center">Register</h2>  
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="first_name" placeholder="First Name" required="required">				
            </div>
        </div>
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required">				
            </div>
        </div>
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-at"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="email" placeholder="Email" required="required">				
            </div>
        </div>
        

        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">				
            </div>
        </div>
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">				
            </div>
        </div>

		   
        <div class="form-group">
            <button type="submit" class="btn btn-primary login-btn btn-block">Register Now</button>
        </div>
        <p class="text-center ">Already have an account? <a href="login">Sign in</a></p>
      
    </form>
    
</div>
<footer class="page-footer font-small" ><div class="footer-copyright text-center"><p style="color: white;font-weight: 100;mix-blend-mode: difference;">&copy; Cloudupp <?= date("Y")?>. All Rights Reserved</p></div></footer>
</body>
</html>
<?php
require_once "config.php";
//require_once "amazon-s3/S3.php";
if(!$_SESSION["loggedin"] == true){

// Redirect user to welcome page
header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Clipboard</title>
  <!-- add icon link -->
  <link rel = "icon" href ="img/clipboard-flat.png"  type = "image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style type="text/css">
  body {
   /* color: #fff;
    background: #63738a;
    background: white;
    font-family: 'Roboto', sans-serif;*/
   /* background-image: url("img/pexels-andrew-neel-2312369.jpg");
    height: 100%; 
    background-position: center; 
    background-repeat: no-repeat; 
    background-size: cover;*/
    background-color:  #f8f9fa;
      
  }
  form {
        text-align: right;
        margin-left:auto;
    }
    input {
        width: 100px;
    }
    .row-margin{
      margin:10px 0px 0px 0px;
    }
    footer{
       /* position:absolute;bottom:0px;*/
        margin-left: 38%;
        margin-right: 38%;
        margin-top:100px
        
    }
</style>
</head>
<body>

<div class="container">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php"><img src="img/clipboard-flat.png" width="30" height="30" class="d-inline-block align-top" alt=""> Clipboard</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php" >Home</a>
      </li>
      <li class="nav-item  active">
        <a class="nav-link" href="gallery.php">Gallery</a>
      </li> 
   
      
    </ul>
    <ul class="navbar-nav" style="margin-left: auto;">
    <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user fa-fw"></i>User
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
          
        </div>
      </li>
    </ul>

  </nav>

  <!--<h2>Uploaded files</h2>  -->
  <div class="row row-margin"  >  
    
    
    <!--<a class="btn btn-large btn-default" href="index.php"><i class="fa fa-arrow-left fa-fw"></i>Back to Clipboard</a>       
    <a class="btn btn-large btn-default " href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>  
    <p class="text-right" style="margin:auto;"><i class="fa fa-user fa-fw"></i> User</p> 
    <form action="flexgallery.php"  method="post">
      <input type="text" name="search" />
      <input type="submit" value="Search" />
    </form>
    
    
  -->
  
    <p >Click on the images to enlarge them.</p> 
   
    <form class="form-inline" action="gallery.php"  method="post">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">Search</button>
  </form>

  </div>

  <div class="row row-margin" style="background:white" >
  <?php
    $user_id = $_SESSION["id"];
    //$dir_name = "uploads/";
    $where="";
    $query="SELECT file_name FROM  images";
    if($user_id == 8){
      $where = "WHERE user_id= ANY(select user_id from images) ";

    }else{
      $where = "WHERE user_id='$user_id'";
    }
    
   
    if(isset($_POST['search']) && !empty(trim($_POST["search"]))){
      $pattern = $_POST["search"];      
      $where =$where. "and file_name LIKE '%".$pattern."%'";
    }

    $query=$query.' '.$where;
    
    $results = mysqli_query($link, $query);
    if (mysqli_num_rows($results) == 0) {

      echo "<h2 style='margin-left: 10px; color: orange;'>No record found for the search.</h2>";

    }

    while($row = mysqli_fetch_array($results)) { 
     
      $image = $row[0];  

  ?>

  
        
               
    <div class="col-md-4">
      <div class="thumbnail" >
        <a href="<?php echo "https://clipboard-uploads-dev.s3.us-east-1.amazonaws.com/".$image ; ?>" target="_blank">
          <img src="<?php echo "https://clipboard-uploads-dev.s3.us-east-1.amazonaws.com/".$image ; ?>" alt="Fjords" style="width:100%">
          <div class="caption" align="center">
            <!--<p><?php echo str_replace("uploads/", '',$image );?></p>-->
            <?=$image ?>
          </div>
        </a>
      </div>      
    </div>

    <?php }?>


  </div>
</div>
<footer class="page-footer font-small" ><div class="footer-copyright"><p >&copy; Clipbaord <?= date("Y")?>. All Rights Reserved</p></div></footer>
</body>
</html>



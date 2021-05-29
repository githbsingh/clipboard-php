<?php
require_once "config.php";
if(!$_SESSION["loggedin"] == true){

// Redirect user to welcome page
header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gallery</title>
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
</style>
</head>
<body>

<div class="container">
  <h2>Uploaded files</h2>  
  <div class="row">
   
    
    
    <a class="btn btn-large btn-default" href="index.php"><i class="fa fa-arrow-left fa-fw"></i>Back to Clipboard</a>       
    <a class="btn btn-large btn-default " href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>  
    <!--<p class="text-right" style="margin:auto;"><i class="fa fa-user fa-fw"></i> User</p> -->
    <form action="flexgallery.php"  method="post">
      <input type="text" name="search" />
      <input type="submit" value="Search" />
    </form>
    
    
  </div>
  
  <p>Click on the images to enlarge them.</p>
  <div class="row" >
  <?php
    $user_id = $_SESSION["id"];
    $dir_name = "uploads/";
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

   // $raw_results = mysql_query("SELECT * FROM articles
		//	WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')") or die(mysql_error());
    $query=$query.' '.$where;
    
    $results = mysqli_query($link, $query);
    if (mysqli_num_rows($results) == 0) {

      echo "<h2 style='margin-left: 10px; color: orange;'>No record found for the search.</h2>";

    }

    while($row = mysqli_fetch_array($results)) { 
      //echo($row[0] . "<BR>");  
      $image = $dir_name.$row[0];  
    /*      $images = glob($dir_name."*.png");
            foreach($images as $image) {
                  
    */
  ?>

  
        
               
    <div class="col-md-4">
      <div class="thumbnail" >
        <a href="<?= $image ?>" target="_blank">
          <img src="<?= $image ?>" alt="Fjords" style="width:100%">
          <div class="caption" align="center">
            <p><?php echo str_replace("uploads/", '',$image );?></p>
          </div>
        </a>
      </div>      
    </div>

    <?php }?>


  </div>
</div>

</body>
</html>



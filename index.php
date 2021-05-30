<?php
require_once "config.php";
if(!$_SESSION["loggedin"] == true){

// Redirect user to welcome page
header("location: login.php");
}
// Include config file
require_once "config.php";
if (isset($_POST)) {
echo $_SESSION['upload_status_msg']="Startng upload....";
if ( 0 < $_FILES['file']['error'] ) {
    echo $_SESSION['upload_status_msg'] = 'Error: ' . $_FILES['file']['error'] . '<br>';
}else {
   // $name='myfile_'.date('m-d-Y_hia');
    //$time = date("d-m-Y")."-".time() ;
    $img=$_FILES['file']['name'];
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $filename = 'image_'.date('mdYhis');
    
//move_uploaded_file($tmpfilename,$store);
    $statusMsg="";
    if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename.'.'.$ext)){

        // Insert image file name into database
        $user_id =  $_SESSION["id"];
        $file_fullname = $filename.'.'.$ext;
        $query = "INSERT into images (user_id,file_name, uploaded_on) VALUES ( $user_id,'".$file_fullname."', NOW())";
        $insert = $link->query($query);
        if($insert){
           echo  $_SESSION['upload_status_msg']= $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
        }else{
           echo  $_SESSION['upload_status_msg']= $statusMsg = "File upload entry failed in your user account, please try again.";
        } 
    }else{
      // echo  $_SESSION['upload_status_msg']= $statusMsg= "File upload failed, please try again.";
    }
    

}
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Clipboard</title>
<!-- add icon link -->
<link rel = "icon" href ="img/clipboard-flat.png"  type = "image/x-icon">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	
	  /*background: #63738a;
    
    background-image: url("img/pexels-andrew-neel-2312369.jpg");*/
    height: 100%; /* You must set a specified height */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover;
    background-color:  #f8f9fa;
}
.row-margin{
  margin:10px 0px 0px 0px;
}
</style>

<script>
  window.onload = function() {
   // $("#previewImg").remove();
  }

  document.onpaste = function(event){

    var items = (event.clipboardData || event.originalEvent.clipboardData).items;

    for (var i = 0 ; i < items.length ; i++) {

      var item = items[i];

      if (item.type.indexOf("image") != -1) {

        var file = item.getAsFile();
        console.log(file);
        previewFile(file);
        upload_file_with_ajax(file);
        
      }
    }
  }
  function previewFile(input){
   
        if (input) {
            var reader = new FileReader();
            reader.onload = function (e) {
              //$("#previewImg").attr("src", e.target.result);
              $("#instruction").hide();
              document.getElementById("previewImg").innerHTML="<img src="+ e.target.result +" style='width: 100%;max-height: 600px;object-fit: cover;'/>";
                
            };
            reader.readAsDataURL(input);
        }else{
          console.log("Opps!!");
        }
    }

  function clearImage() {
    //$("#previewImg").remove();
   // $("#previewImg").attr('src', '');
   document.getElementById("previewImg").innerHTML='';
   $("#instruction").show();
  }

  function upload_file_with_ajax(file){

    var formData = new FormData();
    formData.append('file', file);
    $("#notificaton").hide();
   
      
    $.ajax('./index.php' , {

      type: 'POST',
      contentType: false,
      processData: false,
      data: formData,
      error: function() {
        console.log("error");
        $("#notificaton").html('<p>'+error+'</p>');
        $("#notificaton").show();
      }, 
      success: function(res) {
        console.log("Successfully posted file for upload.");
        html = '<h4 style="color:green"><?php if(!isset($_SESSION['upload_status_msg'])){
               echo  $upload_status_msg="Upload message to set";
              }else{
               echo $upload_status_msg = $_SESSION['upload_status_msg'];
              } ?></h4>';    
        $("#notificaton").html(html);
        $("#notificaton").show();
      
      
      }
    });
  }

</script>

</head>
<body>
<div class="container" >
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php"><img src="img/clipboard-flat.png" width="30" height="30" class="d-inline-block align-top" alt=""> Clipboard</a>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php" >Home</a>
      </li>
      <li class="nav-item">
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

  
  <!--<p> Click and paste here.</p>-->
 
  <div class="row row-margin">
    <!--<a class="btn btn-large btn-default" href="gallery.php"><i class="fa fa-file-image-o fa-fw"></i>View files</a> 
    <a class="btn btn-large btn-default" id="clear" onclick="clearImage()"><i class="fa fa-undo fa-fw"></i>Remove preview</a>   
    <a class="btn btn-large btn-default" href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>  
    <p> </p>-->
    <button type="button" class="btn btn-sm btn-outline-dark" id="clear" onclick="clearImage()"><i class="fa fa-clipboard fa-fw"></i>Remove preview</button>
    <div style="margin-left:auto;" id="notificaton"></div>
    <br>
  </div>
  
  
  <div class="row" style="margin: 10px 0px 0px 0px;width: 100%; height: 600px; background: grey; " id="pasteTarget">
  <!--<div class="row" style="width: 100%; height: 600px; background: grey; display: flex; align-items: center; justify-content: center" id="pasteTarget">-->
    <h2 id="instruction" style="margin:auto;">Click and Paste image here</h2>
    <!--<img id="previewImg"  style="width: 100%;max-height: 600px;object-fit: cover;" >-->
    <div id="previewImg"></div>
  </div>
  
  
  

  <!--<p><a href="flexgallery.php">Flex Gallery</a></p>-->
 </div>
</body>
</html>
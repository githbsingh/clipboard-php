<?php
require_once "config.php";
if(!$_SESSION["loggedin"] == true){

// Redirect user to welcome page
header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Clipboard</title>
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
   
      
    $.ajax('./clipboard_js.php' , {

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
        //console.log("ok");
        html = '<h3 style="color:green">File successfully uploaded.</3>';    
        $("#notificaton").html(html);
        $("#notificaton").show();
      
      
      }
    });
  }

</script>

</head>
<body>
<div class="container" >
  <h1>Clipboard</h1>
  <!--<p> Click and paste here.</p>-->
 
  <div class="row">
    <a class="btn btn-large btn-default" href="gallery.php"><i class="fa fa-file-image-o fa-fw"></i>View files</a> 
    <a class="btn btn-large btn-default" id="clear" onclick="clearImage()"><i class="fa fa-undo fa-fw"></i>Remove preview</a>   
    <a class="btn btn-large btn-default" href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>  
    <p> </p>    
    
  </div>
  
  <div class="row" id="notificaton"></div>
  <div class="row" style="width: 100%; height: 600px; background: grey; " id="pasteTarget">
  <!--<div class="row" style="width: 100%; height: 600px; background: grey; display: flex; align-items: center; justify-content: center" id="pasteTarget">-->
    <h2 id="instruction" style="margin:auto;">Click and Paste image here</h2>
    <!--<img id="previewImg"  style="width: 100%;max-height: 600px;object-fit: cover;" >-->
    <div id="previewImg"></div>
  </div>
  
  
  

  <!--<p><a href="flexgallery.php">Flex Gallery</a></p>-->
 </div>
</body>
</html>
<?php
require_once "config.php";
if(!$_SESSION["loggedin"] == true){

// Redirect user to welcome page
header("location: login");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Cloudupp</title>
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
.row-clipboard{

  /*outline: 2px dashed #92b0b3;
  outline-offset: -10px;*/
  -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
  transition: outline-offset .15s ease-in-out, background-color .15s linear;
  width: 100% !important;
  height: 400px;
  background-color:  #ffffff;

}
footer{
       /* position:absolute;bottom:0px;*/
        margin-left: 38%;
        margin-right: 38%;
        margin-top:100px
        
    }

.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
    height:40%
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    content: " or drag it here. ";
    display: block;
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
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
    html = '<h4 style="color:green">Uploading......</h4>';    
    $("#notificaton").html(html);       
    $("#notificaton").show();
   
      
    $.ajax('./clipboard_js.php' , {

      type: 'POST',
      contentType: false,
      processData: false,
      data: formData,
      error: function() {
        console.log("error");
        html = '<h4 style="color:orange">Error occurred while uploading your image, please try again later.</h4>';    
        $("#notificaton").html(html);       
        $("#notificaton").show();
      }, 
      success: function(res) {
        console.log(res);
        //html = '<p style="color:orange">'+res+'</p>';
        html = '<h4 style="color:green">The file has been uploaded successfully.</h4>';    
        $("#notificaton").html(html);
        $("#notificaton").show();
      
      
      }
    });
  }
  function saveText() {
    var text = document.getElementById('textareainput')
    //copyText.value();
    //document.execCommand('copy')
    console.log(text.value)
  }
  function clearTextArea() {
    document.getElementById("textareainput").innerHTML='';
  }

</script>

</head>
<body>
<div class="container" >
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
  <!-- Brand -->
  <a class="navbar-brand" href="./"><img src="img/clipboard-flat.png" width="30" height="30" class="d-inline-block align-top" alt=""> Cloudupp</a>
    <ul class="navbar-nav" style="margin-left: auto;">
      <li class="nav-item active">
        <a class="nav-link" href="index" >Tools</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gallery">Files</a>
      </li>
   
   
      
   <!-- </ul>
    <ul class="navbar-nav" >-->
    <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user fa-fw"></i>User
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.">Profile</a>
          <a class="dropdown-item" href="logout">Logout</a>
          
        </div>
      </li>
    </ul>

  </nav>
  
  <br>
  
   
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Paste Image</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab1">Upload</a>
    </li>
    <!--<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab2">Text</a>
    </li>-->
  </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
       <!--<p> Click and paste here.</p>-->
    
        <div class="row row-margin">
        
          <button type="button" class="btn btn-sm btn-outline-dark" id="clear" onclick="clearImage()"><i class="fa fa-clipboard fa-fw"></i>Remove preview</button>
          <div style="margin-left:auto;" id="notificaton"></div>
          
        </div>
        <br>
        
        
        <div class="row row-clipboard border"  id="pasteTarget">
        
          <h2 id="instruction" style="margin:auto;">Click and Paste image here to upload</h2>
                  <div id="previewImg"></div>
        </div>  
      </div>
      <div id="tab1" class="container tab-pane fade"><br>
               
        <div class="row">
        <div id="notificaton1" class="col-md-12"></div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <form id="uploadForm" enctype="multipart/form-data">  
                  <div class="form-group files">
                    <label>Upload Your File </label>
                    <input id="uploadFileId" name="file" type="file" class="form-control" multiple="">
                  </div>
                  <div class="form-group text-center">
                  <input  type="submit" name="submit" class="btn btn-outline-primary"  value="Upload" >
                  </div>
            </form>
        </div>    
  
      </div>



      </div>
      <div id="tab2" class="container tab-pane fade"><br>
      
        
        <div class="row">
          <div class="col-md-12">
                <div class="form-group file">    
                    <textarea id="textareainput" class="form-control" style="height: 300px;" rows="3" placeholder="Paste text here"></textarea>
                </div>
          </div>    
        </div>
        <div class="raw" style="text-align:center">
          <!--<label>Paste text here </label>-->
          <button onclick="clearTextArea()" class="btn btn-outline-dark"  type="submit" value="Save">Cear</button>
          <button onclick="saveText()" class="btn btn-outline-primary"   type="submit" value="Save">Save</button>
        </div> 
      </div>
    </div><!-- Tab panes End-->
      

      <!--<p><a href="flexgallery.php">Flex Gallery</a></p>-->
  </div><!-- Container End -->
 <footer class="page-footer font-small" ><div class="footer-copyright text-center"><p style="color: white;font-weight: 100;mix-blend-mode: difference;">&copy; Cloudupp <?= date("Y")?>. All Rights Reserved</p></div></footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  // File type validation
  $("#uploadFileId").change(function() {
      var file = this.files[0];
      var fileType = file.type;
      var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg','text/plain','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
      if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]) || (fileType == match[6])|| (fileType == match[7]) || (fileType == match[8]))){
          alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.' + fileType);
          $("#uploadFileId").val('');
          return false;
      }
  });

  // Submit form data via Ajax
$(document).ready(function (e){
  $("#uploadForm").on('submit',(function(e){
    e.preventDefault();
    html = '<p style="color:green">Uploading......</p>';    
    $("#notificaton1").html(html);       
    $("#notificaton1").show();
    var formData = new FormData();

    console.log("Form Data:"+JSON.stringify(formData));  
    $.ajax({
      url: "upload.php",
      type: "POST",
      data:  new FormData(this),  
      contentType: false,
      cache: false,
      processData:false,
      error: function() {
        console.log("error");
        html = '<p style="color:orange">Error occurred while uploading your file, please try again later.</p>';    
        $("#notificaton1").html(html);       
        $("#notificaton1").show();
      }, 
      success: function(res) {
        console.log("Response:"+JSON.stringify(res));
        if(res.status == 0){
          html = '<p style="color:red">'+res.message+'</p>';          
          
        }else{
          html = '<p style="color:green">The file has been uploaded successfully.</p>';
        }
        $("#notificaton1").html(html);
        $("#notificaton1").show(); 

      
      }	        
    });
  }));
});

</script>
</html>


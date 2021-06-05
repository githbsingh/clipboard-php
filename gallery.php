<?php
require_once "config.php";
//require_once "amazon-s3/S3.php";
if(!$_SESSION["loggedin"] == true){

// Redirect user to welcome page
header("location: login");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cloudupp</title>
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
 <!-- Start Main Container>-->
<div class="container"> 
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <!-- Brand -->
    <a class="navbar-brand" href="./"><img src="img/clipboard-flat.png" width="30" height="30" class="d-inline-block align-top" alt=""> Cloudupp</a>
    <ul class="navbar-nav"  style="margin-left: auto;">
      <li class="nav-item">
        <a class="nav-link" href="index" >Tools</a>
      </li>
      <li class="nav-item  active">
        <a class="nav-link" href="gallery">Files</a>
      </li> 
   
      
    <!--</ul>
    <ul class="navbar-nav navbar-right" >-->
    <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user fa-fw"></i>User
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile">Profile</a>
          <a class="dropdown-item" href="logout">Logout</a>
          
        </div>
      </li>
    </ul>

  </nav><br>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="myTab">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#gallery">Gallery</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#files">Files</a>
    </li>
    <!--<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#carousel">Carousel</a>
    </li>-->
 
 
  </ul><br>

  <!-- Tab panes -->
  <div class="tab-content" id="myTabContent">
      <!--Start Carousel Tab-->
      <div class="tab-pane fade" id="carousel" role="tabpanel" aria-labelledby="carousel-tab">

      <?php 
        
            $user_id = $_SESSION["id"];       
            $where="";
            $query="SELECT file_name FROM  images";
            if($user_id == 8){
              $where = "WHERE user_id= ANY(select user_id from images) and file_type='image' ";
            }else{
              $where = "WHERE user_id='$user_id'  and file_type='image'";
            }           
            
            if(isset($_POST['search']) && !empty(trim($_POST["search"]))){
              $pattern = $_POST["search"];      
              $where =$where. "and file_name LIKE '%".$pattern."%'";
            }
            $order=" order by uploaded_on desc" ;
            $query=$query.' '.$where.$order;
            
            $results = mysqli_query($link, $query);
      ?>
            
            
        

        <!--Carousel Wrapper-->
        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
          <!--Slides-->
          <div class="carousel-inner" role="listbox">

            <?php 
              $count=0;
              while($row = mysqli_fetch_array($results)) { 
              
                $imageurl = "https://clipboard-uploads-dev.s3.us-east-1.amazonaws.com/".$row[0];
                if($count == 0){
            ?>
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?=$imageurl?>"
                alt="First slide">
            </div>
            <?php }else{ ?>

              <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageurl?>"
                alt="First slide">
              </div>
            <?php } $count = $count + 1;} ?>  
          </div>
          <!--/.Slides-->
          <!--Controls-->
          <a class="carousel-control-prev " href="#carousel-thumb" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next " href="#carousel-thumb" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <!--/.Controls
          <ol class="carousel-indicators">
            <li data-target="#carousel-thumb" data-slide-to="0" class="active">
              <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(88).jpg" width="100">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="1">
              <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(121).jpg" width="100">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="2">
              <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(31).jpg" width="100">
            </li>
          </ol>-->
        </div>
        <!--/.Carousel Wrapper-->
        
        
      </div>
      <!--End Carousel Tab-->
      <div class="tab-pane fade show active" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
    
        
        <!--<h2>Uploaded files</h2>  -->
        <div class="row row-margin"  >  
          
      
        
          <p >Click on the images to enlarge them.</p> 
        
          <form class="form-inline" action="gallery"  method="post">
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
              $where = "WHERE user_id= ANY(select user_id from images) and file_type='image' ";

            }else{
              $where = "WHERE user_id='$user_id'  and file_type='image'";
            }
            
            
            if(isset($_POST['search']) && !empty(trim($_POST["search"]))){
              $pattern = $_POST["search"];      
              $where =$where. "and file_name LIKE '%".$pattern."%'";
            }
            $order=" order by uploaded_on desc" ;
            $query=$query.' '.$where.$order;
            
            $results = mysqli_query($link, $query);
            if (mysqli_num_rows($results) == 0) {

              echo "<h2 style='margin-left: 10px; color: orange;'>No record found for the search.</h2>";

            }

            while($row = mysqli_fetch_array($results)) { 
            
              $image = $row[0];  
              $imageurl = "https://clipboard-uploads-dev.s3.us-east-1.amazonaws.com/".$image; 
              $url_id = "url_".pathinfo($image, PATHINFO_FILENAME);

          ?>

                    
          <div class="col-md-4">

            <a data-target="#<?=pathinfo($image, PATHINFO_FILENAME)?>" data-toggle="modal" href="#" class="color-gray-darker td-hover-none">
            <div class="thumbnail" >
              <!--<a href="<?php echo $imageurl ; ?>" target="_blank">-->
                <img src="<?php echo $imageurl; ?>" alt="" style="width:100%">
                <div class="caption" align="center">
                  <!--<p><?php echo str_replace("uploads/", '',$image );?></p>-->
                  <?=pathinfo($image, PATHINFO_FILENAME) ?>
                </div>
              </a>
            </div>      
          </div>

          <!--Modal start-->
          <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="<?=pathinfo($image, PATHINFO_FILENAME)?>" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body mb-0 p-0">
                  <img src="<?php echo $imageurl; ?>" alt="" style="width:100%">
                </div>
                <div class="text-center"><a href="<?=$imageurl ?>"><?=pathinfo($image, PATHINFO_FILENAME) ?></a></div>
                <div class="modal-footer" style="border-top:0">
                <!--<input type="text" id="<?=$url_id?>" value="<?=$imageurl?>">-->
                <div id="<?=$url_id?>" ></div>
                  <div><a  class="btn btn-outline-success btn-rounded btn-md ml-4 text-center" href="enlarge-image?image=<?php echo $image; ?>" target="_blank">Open</a></div>
                  <div><a  class="btn btn-outline-success btn-rounded btn-md ml-4 text-center" href="<?php echo $imageurl; ?>" target="_blank">Download</a></div>
                  
                  <button class="btn btn-outline-success btn-rounded btn-md ml-4 text-center" value="Copy Link" name="<?=$url_id?>" type="button" onclick="handleCopyTextFromTextArea(<?=$url_id?>,'<?=$imageurl ?>')">Copy Link</button>
                  <button class="btn btn-outline-primary btn-rounded btn-md ml-4 text-center" data-dismiss="modal" type="button">Close</button>
                
              
                </div>
              </div>
            </div>
          </div>

          <?php }?>


        </div>
      </div>       
             
  
    <!--End Gallery Tab-->
    <!--Start Files Tab-->
    <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
        <div class="row  row-margin">
         <form class="form-inline" ><input class="form-control mr-sm-2" id="searchInput" type="search" name="search" placeholder="Search" aria-label="Search"></form>
        </div>
        <div class="row  row-margin">
          <table id="filesTable" class="table  table-sm table-striped">
            <thead>
              <tr>
                <th width="5%" scope="col">#</th>
                <th width="5%" scope="col">Type</th>
                <th scope="col">File Name</th>
                <th scope="col">Uploaded Date</th>
                <th scope="col">Status</th>
                <th width="8%" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>


            <?php
                $user_id_files = $_SESSION['id'];       
                $where_files="";
                $query_files="SELECT * FROM  images";
                if($user_id_files == 8){
                  $where_files = "WHERE user_id= ANY(select user_id from images) ";

                }else{
                  $where_files = "WHERE user_id='$user_id_files'";
                }
                
              
              /* Createif(isset($_POST['search']) && !empty(trim($_POST["search"]))){
                  $pattern = $_POST["search"];      
                  $where =$where. "and file_name LIKE '%".$pattern."%'";
                }*/
                $order_files=" order by uploaded_on desc" ;
                
                $query_files=$query_files.' '.$where_files.$order_files;
                
                $results_files = mysqli_query($link, $query_files);
                if (mysqli_num_rows($results_files) == 0) {

                  echo "<h2 style='margin-left: 10px; color: orange;'>No record found for the search.</h2>";

                }
                $count=0;
                $image_extension = array(
                    "png",
                    "jpg",
                    "jpeg",
                    "gif"
                );
                while($row = mysqli_fetch_array($results_files)) { 
                  $count=$count + 1;
                  $id = $row[0];                 
                  $file_name = $row[2]; 
                  $file_type = $row[5];
                  $file_uploaded_on = $row[3];  
                  $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                  if(in_array($ext, $image_extension)) {
                    $file_icon = '<i class="fa fa-file-image-o  fa-2x fa-fw" style="color:red"></i>';
                  }elseif($ext == "pdf" ){
        
                    $file_icon = '<i class="fa fa-file-pdf-o fa-2x fa-fw" style="color:red"></i>';
                  }elseif($ext == "txt" ){

                    $file_icon = '<i class="fa fa-file-text-o fa-2x fa-fw" style="color:#17a2b8"></i>';
                    
                  }elseif($ext == "xls" || $ext == "xlsx"){

                    $file_icon = '<i class="fa fa-file-excel-o fa-2x fa-fw" style="color:#28a745"></i>';
                    
                  }elseif($ext == "doc" || $ext == "docx"){

                    $file_icon = '<i class="fa fa-file-word-o fa-2x fa-fw" style="color:#007bff"></i>';
                    
                  }
                  else{

                    $file_icon = '<i class="fa fa-file-o fa-2x fa-fw" ></i>';
                    
                  }
                
                  $file_url = "https://clipboard-uploads-dev.s3.us-east-1.amazonaws.com/".$file_name; 
                // $url_id = "url_".pathinfo($image, PATHINFO_FILENAME);

              ?>
              <tr>
                <th scope="row"><?=$count?></th>
                <td><?=$file_icon?></td>
                <td><?=$file_name?></td>
                <td><?=$file_uploaded_on?></td>
                <td><?=($row[4] == '1'? 'Exist':'Deleted')?></td>
                <td><a href="<?=$file_url?>" data-toggle="tooltip" title="Download file"><i class="fa fa-download fa-fw"></i></a><a data-toggle="tooltip" title="Delete file" onclick="deleteFile('<?=$id?>','<?=$file_name?>');"><i class="fa fa-trash fa-fw"  style="color:red"></i></a><?php if($file_type=='image'){?><a href="enlarge-image?image=<?=$file_name?>" data-toggle="tooltip" title="View image" target="_blank"><i class="fa fa-search-plus fa-fw"></i></a><?php } ?></td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
        <div>
        
    </div>
    <!--End Files Tab-->
    
   
  
 
  </div>
    <!-- End Tab Panes>-->
</div>    <!-- End Main Container>-->
<footer class="page-footer font-small"><div class="footer-copyright text-center"><p style="color: white;font-weight: 100;mix-blend-mode: difference;">&copy; Cloudupp <?= date("Y")?>. All Rights Reserved</p></div></footer>

<script type="text/javascript">

  function copyLink(url){
    console.log(url.id);
    /*alert("Copy text to Clipboard: " + url.id);*/
    var element = document.getElementById(url.id);  
    element.select();  
    document.execCommand("copy");
    console.log("Copy text to Clipboard: " + url.value);
    alert("Link Copied to Clipboard: " + url.value);
  }

  function copyUrl($url){
 
    var inputc = document.body.appendChild(document.createElement("input"));
    inputc.value = window.location.href;
    inputc.focus();
    inputc.select();
    document.execCommand('copy');
    inputc.parentNode.removeChild(inputc);
    alert("URL Copied."+inputc.value);
  }
  function handleCopyTextFromTextArea(uid,text) {
    const body = document.querySelector('body');
  //  const paragraph = document.querySelector('p');
    var element = document.getElementById(uid.id);  
    const area = document.createElement('textarea');
    element.appendChild(area);

    area.value = text// paragraph.innerText;
    area.select();
    document.execCommand("copy");    
    console.log("Link Copied to Clipboard: " + area.value);
    var copyButton = document.getElementsByName(uid.id);
    copyButton.innerHTML = "Copied";
    alert("Copied!!"+copyButton.value+uid.id);
    element.removeChild(area);
  }

  $(document).ready(function(){
    $("#searchInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#filesTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

  //Onclick delete
  function deleteFile(file_id,file_name) {
			if((file_id === undefined) ){
				alert("File id - "+file_id+"is empty!");
				return;
			}
      //console.log("Deleting file for id:"+file_id);
			$.ajax({
              url: "delete-file.php",
              method: "POST",
              data: {					   
                       id: file_id,
                       file_name: file_name
                       
              },
              dataType: "text",
              success: function (data) {
                  console.log(data)
                 // document.location.href = 'gallery.php#files';
              }

      });
			
  }

  //Keep selected tab on page refresh
  $('#myTab a').click(function(e) {
    e.preventDefault();
    $(this).tab('show');
  });

  // store the currently selected tab in the hash value
  $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });

  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  $('#myTab a[href="' + hash + '"]').tab('show');

  //Tooltips
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });


</script>

</body>
</html>



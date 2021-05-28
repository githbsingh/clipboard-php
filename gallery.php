<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gallery</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Uploaded files</h2>  
  <p><a href="index.php">Back to Clipboard</a></p>
  <p>Click on the images to enlarge them.</p>
  <div class="row">
   
    <?php
        $dir_name = "uploads/";
        $images = glob($dir_name."*.png");
        foreach($images as $image) {
    ?>              
               
    <div class="col-md-4">
      <div class="thumbnail">
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



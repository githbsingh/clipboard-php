<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
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
              $("#previewImg").attr("src", e.target.result);
                
            };
            reader.readAsDataURL(input);
        }else{
          console.log("Opps!!");
        }
    }

  function clearImage() {
    //$("#previewImg").remove();
    $("#previewImg").attr('src', '');
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
        console.log("ok");
        html = '<h2 style="color:green">File successfully uploaded.</h2>';    
        $("#notificaton").html(html);
        $("#notificaton").show();
      }
    });
  }

</script>

</head>
<body>
<h1>Clipboard</h1>
<p><a href="gallery.php">Uploaded files</a></p>
<p> Click and paste here.</p><p id="clear" onclick="clearImage()">Clear</p>
<div id="notificaton"></div>
<div style="width: 100%; height: 600px; background: grey" id="pasteTarget">

<img id="previewImg" src="" style="width: 100%;height: 600px;object-fit: cover;" >
</div>

<!--<p><a href="flexgallery.php">Flex Gallery</a></p>-->
 
</body>
</html>
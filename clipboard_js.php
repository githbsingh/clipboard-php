<?php
    // Initialize the session
    session_start();
    
    
    // Include config file
    require_once "config.php";

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
       // $name='myfile_'.date('m-d-Y_hia');
        //$time = date("d-m-Y")."-".time() ;
        $img=$_FILES['file']['name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $filename = 'image_'.date('mdYhis');
        
    //move_uploaded_file($tmpfilename,$store);
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename.'.'.$ext)){

            // Insert image file name into database
            $user_id =  $_SESSION["id"];
            $file_fullname = $filename.'.'.$ext;
            $query = "INSERT into images (user_id,file_name, uploaded_on) VALUES ( $user_id,'".$file_fullname."', NOW())";
            $insert = $link->query($query);
            if($insert){
                echo $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                echo $statusMsg = "File upload entry failed in your user account, please try again.";
            } 
        }else{
            echo $statusMsg= "File upload failed, please try again.";
        }
        

    }



?>
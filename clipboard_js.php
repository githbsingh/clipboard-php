<?php
    // Initialize the session
    session_start();
    
    
    // Include config file
    require_once "config.php";
    require_once "amazon-s3/S3.php";

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
       // $name='myfile_'.date('m-d-Y_hia');
        //$time = date("d-m-Y")."-".time() ;
        $img=$_FILES['file']['name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $filename = 'image_'.date('mdYhis');
        $file_fullname = $filename.'.'.$ext;
        
        /*//move_uploaded_file($tmpfilename,$store);
        $statusMsg="";
        if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename.'.'.$ext)){

            // Insert image file name into database
            $user_id =  $_SESSION["id"];
            $file_fullname = $filename.'.'.$ext;
            $query = "INSERT into images (user_id,file_name, uploaded_on) VALUES ( $user_id,'".$file_fullname."', NOW())";
            $insert = $link->query($query);
            if($insert){
                $_SESSION['upload_status_msg']=$statusMsg = "The file ".$filename. " has been uploaded successfully.";
            }else{
                $_SESSION['upload_status_msg']=$statusMsg = "File upload entry failed in your user account, please try again.";
            } 
        }else{
            $_SESSION['upload_status_msg']= $statusMsg= "File upload failed, please try again.";
        }
        return json_encode($_FILES['file']);
        */

        //Aws s3 bucket file upload - Start

        $tmpfile = $_FILES['file']['tmp_name'];
        $file = $_FILES['file']['name'];
        $statusMsg="";
        echo $bucketName = 'clipboard-uploads';
        if (defined('AWS_S3_URL')) {
            echo  "Persist to AWS S3 and delete uploaded file";
            //require_once('S3.php');
            S3::setAuth(AWS_S3_KEY, AWS_S3_SECRET);
            S3::setRegion(AWS_S3_REGION);
            S3::setSignatureVersion('v4');
            // Create a bucket with public read access
            if (S3::putBucket($bucketName, S3::ACL_PUBLIC_READ)) {
                echo "Created bucket clipboard-uploads";
                //if(S3::putObject(S3::inputFile($tmpfile), AWS_S3_BUCKET, 'clipboard-uploads/'.$file, S3::ACL_PUBLIC_READ)){
                if (S3::putObjectFile($tmpfile, $bucketName, $file_fullname, S3::ACL_PUBLIC_READ)) {

                    // Insert image file name into database
                    $user_id =  $_SESSION["id"];
                    $file_fullname = $filename.'.'.$ext;
                    $query = "INSERT into images (user_id,file_name, uploaded_on) VALUES ( $user_id,'".$file_fullname."', NOW())";
                    $insert = $link->query($query);

                    //echo "S3::listBuckets(): ".print_r(S3::listBuckets(), 1)."</b>";
                    // Get the contents of our bucket
                    $contents = S3::getBucket($bucketName);
                    //echo "S3::getBucket(): Files in bucket {$bucketName}: ".print_r($contents, 1);

                    foreach($contents as $content){

                        echo $content['name'];
                    }


                    // Get object info
                    $info = S3::getObjectInfo($bucketName, $file_fullname);
                    echo "S3::getObjectInfo(): Info for {$bucketName}/".$file_fullname.': '.print_r($info, 1);
                
                  }else{
      
                     echo "S3::putObjectFile(): Failed to copy file"."</b>";
                  }
      
                  unlink($tmpfile);
            }else{

                echo "S3::putObjectFile failed";
            }    
            
        } else {
            // Persist to disk
            $path = 'path/to/user/files/'.$file;
            move_uploaded_file($tmpfile, $path);
        }
        echo "S3::listBuckets(): ".print_r(S3::listBuckets(), 1)."</b>";
         //Aws s3 bucket file upload -End
         return json_encode($statusMsg);

    }



?>
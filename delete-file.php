<?php 
// Initialize the session
session_start();
    
    
// Include config file
require_once "config.php";
require_once "amazon-s3/S3.php";

if(isset($_POST['id'])){

    echo "Deleting file with id-".$_POST['id']."......\n";
    
    echo "File Name:".$_POST['file_name']."\n";
    //return json_encode($_POST['file_name']);

    if (defined('AWS_S3_URL')) {
        // Persist to AWS S3 and delete uploaded file
        //require_once('S3.php');
        $bucketName = 'clipboard-uploads';
        $file_name = $_POST['file_name'];
        S3::setAuth(AWS_S3_KEY, AWS_S3_SECRET);
        S3::setRegion(AWS_S3_REGION);
        S3::setSignatureVersion('v4');

        // Delete our file
        $contents = S3::getBucket(AWS_S3_BUCKET);
        //echo "S3::getBucket(): Files in bucket {$bucketName}: ".print_r($contents, 1);

        foreach($contents as $content){

           echo $content['name']."\n";
        }
        // Get the access control policy for a bucket:
		$acp = S3::getAccessControlPolicy(AWS_S3_BUCKET);
		//echo "S3::getAccessControlPolicy(): {".AWS_S3_BUCKET."}: ".print_r($acp, 1);
        // Update an access control policy ($acp should be the same as the data returned by S3::getAccessControlPolicy())
		S3::setAccessControlPolicy(AWS_S3_BUCKET, '', $acp);
		$acp = S3::getAccessControlPolicy(AWS_S3_BUCKET);
		//echo "S3::getAccessControlPolicy(): {".AWS_S3_BUCKET."}: ".print_r($acp, 1);

        if (S3::deleteObject(AWS_S3_BUCKET, 'camille-minouflet-d7M5Xramf8g-unsplash.jpg')) {
        /*$deleteResult = S3::deleteObject([
            'Bucket' => "$bucketName",
            'Key' => "$file_name",
        ]);
        if($deleteResult){*/
            echo "S3::deleteObject(): Deleted file\n";

            $file_id = $_POST['id'];
            $user_id =  $_SESSION["id"];
            
            $query = "update images set status= '0' where user_id=".$user_id." and id=".$file_id;
            $update = $link->query($query);
            if($update){

                echo "File deleted successfully\n";
            }else{

                echo "Deleting file fiald.\n";
            }


        } else {
            echo "S3::deleteObject(): Failed to delete file\n";
        }
    }

    
}



return json_encode($_POST['id']);

?>
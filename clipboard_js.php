<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
       // $name='myfile_'.date('m-d-Y_hia');
        //$time = date("d-m-Y")."-".time() ;
        $img=$_FILES['file']['name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $filename = 'image_'.date('mdYhis');
        $store = "cvs/".$filename ; 
//move_uploaded_file($tmpfilename,$store);
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename.'.'.$ext);
    }



?>
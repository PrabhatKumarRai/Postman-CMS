<?php

session_start();

include_once __DIR__.'/../model/Corausal.class.php';
include_once __DIR__.'/../includes/plugins/image_upload.inc.php';

//Insert Operation
if(isset($_GET['insert'])){

    if(empty($_FILES['photo']['name'])){
        $_SESSION["msg"] = "No Image Selected!!!";
        $_SESSION["class"] = "danger";
        
        header("Location: ../view/gallery.php");
        exit;
    }
    else{
        //calling image upload function from image_upload.inc.php to upload the image
        $image[1] = imageUpload("corausal.php", "corausal", "corausal");

        $localpath = $image[1];
                
        $image = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $image[1]));        //array to string conversion and getting relative path for image destination
        
        $upload = new Corausal();
        $result = $upload->SetImage($image, $localpath);

        if($result == 0){
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/corausal.php");
            exit;
        }
        else{
            $_SESSION["msg"] = "Image Uploaded Successfully!!!";
            $_SESSION["class"] = "success";
            
            header("Location: ../view/corausal.php");
            exit;
        }
    }
}

//Delete Operation
elseif(isset($_POST['delete'])){

    $id = $_GET['delete'];

    $delete = new Corausal();
        
    $unlink = $delete->GetSingleImage($id);
    
    $result = $unlink->fetch_assoc();

    if(!empty($result['image'])  && file_exists($result['local_path'])){
        if(unlink($result['local_path']) == FALSE){
            $_SESSION["msg"] = "Media Deletion Error!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/corausal.php");
            exit;
        }
    }

    $result = $delete->DeleteImage($id);
    
    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";
        
        header("Location: ../view/corausal.php");
        exit;
    }
    else{

        $_SESSION["msg"] = "Image Deleted Successfully!!!";
        $_SESSION["class"] = "success";
        
        header("Location: ../view/corausal.php");
        exit;
    }
}

else{
    header("Location: ../index.php");
    exit;
}
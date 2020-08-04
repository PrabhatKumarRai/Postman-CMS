<?php

session_start();

include_once __DIR__.'/../model/gallery.class.php';
include_once __DIR__.'/../includes/plugins/image_upload.inc.php';

//Insert Image
if(isset($_GET['insert'])){

    if(empty($_FILES['photo']['name'])){
        $_SESSION["msg"] = "No Image Selected!!!";
        $_SESSION["class"] = "danger";
        
        header("Location: ../view/gallery.php");
        exit;
    }
    else{
        
        //calling image upload function from image_upload.inc.php to upload the image
        $image[1] = imageUpload("gallery.php", "gallery", "gallery");           
        $localpath = $image[1];
        $image = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $image[1]));        //array to string conversion and getting relative path for image destination
        
        $caption = htmlentities($_POST['caption']); 
        
        $upload = new Gallery();
        $result = $upload->SetImage($image, $caption, $localpath);
        
        if($result == 0){
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: " . ROOT_URL_ADMIN . "view/gallery.php");
            exit;
        }
        else{
            $_SESSION["msg"] = "Image Uploaded Successfully!!!";
            $_SESSION["class"] = "success";
            
            header("Location: " . ROOT_URL_ADMIN . "view/gallery.php");
            exit;
        }
    }
}

//Edit Image
elseif(isset($_GET['edit'])){
    
    $id = $_GET['edit'];
    $caption = htmlentities($_POST['caption']);

    $edit = new Gallery();
    $result = $edit->UpdateImage($id, $caption);
    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";
        
        header("Location: ../view/gallery.php");
        exit;
    }
    else{
        $_SESSION["msg"] = "Image Updated Successfully!!!";
        $_SESSION["class"] = "success";
        
        header("Location: ../view/gallery.php");
        exit;
    }
}

//Delete Image
elseif(isset($_GET['delete'])){
    
    $id = $_GET['delete'];

    $delete = new Gallery();

    $unlink = $delete->GetSingleImage($id);
    
    $result = $unlink->fetch_assoc();

    if(!empty($result['image'])  && file_exists($result['local_path'])){
        if(unlink($result['local_path']) == FALSE){
            $_SESSION["msg"] = "Media Deletion Error!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/gallery.php");
            exit;
        }
    }

    $result = $delete->DeleteImage($id);
    
    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";
        
        header("Location: ../view/gallery.php");
        exit;
    }
    else{
        $_SESSION["msg"] = "Image Deleted Successfully!!!";
        $_SESSION["class"] = "success";
        
        header("Location: ../view/gallery.php");
        exit;
    }
}

else{
    header("Location: ../index.php");
    exit;
}

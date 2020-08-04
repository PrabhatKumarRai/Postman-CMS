<?php

include_once __DIR__.'/../../config/config.php';

//Parent path is the page which took the input from the user
//Prefix is used for the prefix of the image
//Parent folder is used for the parent folder of the image which is under under the uploads folder

function imageUpload($parentpath, $prefix, $parentfolder){
    if(!empty($_FILES['photo']['name'])){
        
        $fileName = $_FILES['photo']['name'];
        $tmpName = $_FILES['photo']['tmp_name'];
        $fileSize = $_FILES['photo']['size'];    
        $fileType = $_FILES['photo']['type'];    
        $error = $_FILES['photo']['error'];
    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg', 'jpeg', 'png');
        $maxSize = 2*1024*1024;  //2 mb in bytes
    
        if(!in_array($fileActualExt, $allowed)){
    
            $_SESSION["msg"] = "File Type Not Supported!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: " . ROOT_URL_ADMIN . "view/$parentpath");
            exit;
        }
        else{
            if($error === 0){
                if($fileSize > $maxSize){
                    $_SESSION["msg"] = "File Size Too Big!!!";
                    $_SESSION["class"] = "danger";
    
                    header("Location: " . ROOT_URL_ADMIN . "view/$parentpath");
                    exit;
                }
                else{
                    
                    //-----------SUCCESS---------//
                    $fileNewName = $prefix . "_" . rand() . rand() . "." . $fileActualExt;
                    $destination = '../../uploads/' . $parentfolder . "/" . $fileNewName;
        
                    move_uploaded_file($tmpName, $destination);
                    
                    return $destination;
                }
            }
            else{
                    $_SESSION["msg"] = "An Error Occured while uploading the file!!!";
                    $_SESSION["class"] = "danger";
    
                    header("Location: " . ROOT_URL_ADMIN . "view/$parentpath");
                    exit;
            }
    
        }
    
    }
    else{
        return '';
    }
}
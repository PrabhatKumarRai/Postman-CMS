<?php

session_start();

include_once __DIR__.'/../model/users.class.php';
include_once __DIR__.'/../../config/config.php';
include_once __DIR__.'/../includes/plugins/image_upload.inc.php'; 

//Insert Section
if($_GET['insert']){

}

//Update Section
elseif(isset($_GET['update'])){
    $id = htmlentities($_POST['id']);
    $update = $_GET['update'];
    
    switch($update){
        //Account Setting
        case 1: 
            $name = htmlentities($_POST['name']);
            $designation = htmlentities($_POST['designation']);
            $dob = htmlentities($_POST['dob']);
            $mobile = htmlentities($_POST['mobile']);
            $about = htmlentities($_POST['about']);

            if(!empty($_POST['current_photo']) && empty($_FILES['photo']['name'])){
                $image = $_POST['current_photo'];       //Existing/old Image, if any..
            }
            
            if(empty($name) || empty($designation) || empty($dob)){
                $_SESSION['msg'] = "Empty Compulsary Feilds";
                $_SESSION['class'] = "danger";
                header("Location: ../view/settings.php");
                exit;
            }

            $update = new Users();

            //calling image upload function from image_upload.inc.php to upload the image
            if(!empty($_FILES['photo']['name'])){
                $image = imageUpload("settings.php", "profile_image", "profile_image");
                $localpath = $image;
                $image = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $image));        //array to string conversion and getting relative path for image destination
                

                $unlink = $update->ReadSingleUser('u_id', $id);
                
                $result = $unlink->fetch_assoc();
            
                if(!empty($result['u_image'])  && file_exists($result['local_path'])){
                    if(unlink($result['local_path']) == FALSE){
                        $_SESSION["msg"] = "Media Deletion Error!!!";
                        $_SESSION["class"] = "danger";
                        
                        header("Location: ../view/gallery.php");
                        exit;
                    }
                }
            }
            

            $result = $update->UpdateUserAccountInfo($id, $name, $designation, $dob, $mobile, $about, $image, $localpath);
            

            if($result == 0){
                $_SESSION['msg'] = "SQL ERROR OCCURED";
                $_SESSION['class'] = "danger";
                header("Location: ../view/settings.php");
                exit;
            }
            else{
                $_SESSION['msg'] = "Settings Updated Successfully";
                $_SESSION['class'] = "success";
                header("Location: ../view/settings.php");
                exit;
            }
        break;

        //Social Media Setting
        case 2: 
            $facebook = htmlentities($_POST['facebook']);
            $twitter = htmlentities($_POST['twitter']);
            $instagram = htmlentities($_POST['instagram']);

            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $email = $_POST['email'];
            }
            else{
                $email = '';
            }
        
            $update = new Users();
            $result = $update->UpdateUserSocialInfo($id, $facebook, $twitter, $instagram, $email);
        
            if($result == 0){
                $_SESSION['msg'] = "SQL Error Occured!!!";
                $_SESSION['class'] = "danger";
                header("Location: ../view/settings.php");
            }
            else{
                $_SESSION['msg'] = "Settings Updated Successfully";
                $_SESSION['class'] = "success";
                header("Location: ../view/settings.php");
            }
        break;

        //Privacy Setting
        case 3: 
            $oldPass = htmlentities($_POST['old_pass']);
            $newPass = htmlentities($_POST['new_pass']);
            $confirmPass = htmlentities($_POST['confirm_pass']);
            $oldpassobj = new Users();
            $oldpass = $oldpassobj->ReadSingleUser('u_id', $id);
            $row = $oldpass->fetch_assoc();

            if(password_verify($oldPass, $row['u_pass']) == TRUE){
                
                //New and Confirm Password match Validation
                if(strcmp($newPass, $confirmPass) == 0){
                    //Password Length Validation
                    if(strlen($newPass) >= 8){

                        //Password Character Validation
                        if(preg_match("/[a-z]/", $newPass) == 0 || preg_match("/[A-Z]/", $newPass) == 0 || preg_match("/[0-9]/", $newPass) == 0 || preg_match("/[!@#$%]/", $newPass) == 0){     //must contain atleast 1 lower case, 1 upper case, 1 digit and 1 symbol
                            $_SESSION['msg'] = "Password must contain atleast 1 lower case character, 1 upper case character, 1 digit and 1 special symbol!!!";
                            $_SESSION['class'] = "danger";
                            header("Location: ../view/settings.php");
                            exit;
                        }
                        else{
                            $newPass = password_hash($newPass, PASSWORD_BCRYPT);
                            $update = new Users();
                            $result = $update->UpdateUserPrivacyInfo($id, $newPass);
                        
                            if($result == 0){
                                $_SESSION['msg'] = "SQL Error occured";
                                $_SESSION['class'] = "danger";
                                header("Location: ../view/settings.php");
                            }
                            else{
                                $_SESSION['msg'] = "Settings Updated Successfully";
                                $_SESSION['class'] = "success";
                                header("Location: ../view/settings.php");
                            }
                        }
                    }
                    else{
                        $_SESSION['msg'] = "Password must be atleast 8 characters long!!";
                        $_SESSION['class'] = "danger";
                        header("Location: ../view/settings.php");
                    }
                }
                else{
                    $_SESSION['msg'] = "New & Confirm password do not match!!";
                    $_SESSION['class'] = "danger";
                    header("Location: ../view/settings.php");
                }

            }
            else{
                $_SESSION['msg'] = "Incorrect old Password!!";
                $_SESSION['class'] = "danger";
                header("Location: ../view/settings.php");
            }            
        break;
    }
}

//Remove Profile Image
elseif(isset($_GET['remove_image'])){
    $id = $_GET['remove_image'];
    
    $remove_img = new Users;

    $unlink = $remove_img->ReadSingleUser('u_id', $id);
    
    $result = $unlink->fetch_assoc();

    if(!empty($result['u_image'])  && file_exists($result['local_path'])){
        if(unlink($result['local_path']) == FALSE){
            $_SESSION["msg"] = "Media Deletion Error!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/settings.php");
            exit;
        }
    }

    $result = $remove_img->RemoveProfileImg($id, '');

    if($result == 0){
        $_SESSION['msg'] = "SQL ERROR OCCURED";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }
    else{
        $_SESSION['msg'] = "Settings Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: ../view/settings.php");
        exit;
    }
}

//Delete Section
elseif(isset($_GET['delete'])){

}

else{
    header("Location: ../");
}
<?php

session_start();

include_once __DIR__.'/../model/post.class.php';
include_once __DIR__.'/../includes/plugins/image_upload.inc.php';

//Insert Section
if(isset($_POST['insert'])){

    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $author = htmlentities($_POST['author']);
    $commentStatus = htmlentities($_POST['comment_status']);

    if($commentStatus != 0 && $commentStatus !=1){
        $commentStatus = 1;
    }

    if(empty($title) || empty($content) || empty($author)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["image"] = $image;
        $_SESSION["author"] = $author;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: ../view/addPost.php");
        exit;

    }
    else{
        //calling image upload function from image_upload.inc.php to upload the image
        if(!empty($_FILES['photo']['name'])){
            $image[1] = imageUpload("addPost.php", "featured", "featured");
            $localpath = $image[1];
            $image = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $image[1]));        //array to string conversion and getting relative path for image destination
        }
        $insert = new Post();
        $result = $insert->InsertPost($title, $content, $image, $author, $localpath, $commentStatus);

        if($result == 0){
            $_SESSION["title"] = $title;
            $_SESSION["content"] = $content;
            $_SESSION["image"] = $image;
            $_SESSION["author"] = $author;
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: ../view/addPost.php");
            exit;
        }
        else{
            $_SESSION["msg"] = "Post Created Successfully!!!";
            $_SESSION["class"] = "success";
    
            header("Location: ../view/postList.php");
            exit;
        }

    }
}

//New Draft Section
elseif(isset($_POST['draft'])){

    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $author = htmlentities($_POST['author']);
    $commentStatus = htmlentities($_POST['comment_status']);
    $draft = 1;

    if($commentStatus != 0 && $commentStatus !=1){
        $commentStatus = 1;
    }

    if(empty($title) || empty($content) || empty($author)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["image"] = $image;
        $_SESSION["author"] = $author;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: ../view/addPost.php");
        exit;

    }
    else{

        //calling image upload function from image_upload.inc.php to upload the image
        if(!empty($_FILES['photo']['name'])){
            $image[1] = imageUpload("addPost.php", "featured", "featured");
            $localpath = $image[1];
            $image = implode(explode("public/", ROOT_URL_WEBSITE)) . implode(explode('../', $image[1]));        //array to string conversion and getting relative path for image destination
        }

        $DraftPost = new Post();
        $result = $DraftPost->DraftPost($title, $content, $image, $author, $localpath, $commentStatus, $draft);

        if($result == 0){
            $_SESSION["title"] = $title;
            $_SESSION["content"] = $content;
            $_SESSION["image"] = $image;
            $_SESSION["author"] = $author;
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: ../view/addPost.php");
            exit;
        }
        else{
            $_SESSION["msg"] = "Draft Saved Successfully!!!";
            $_SESSION["class"] = "success";
    
            header("Location: ../view/postList.php");
            exit;
        }

    }
}

//Update Post Section
elseif(isset($_POST['update'])){

    $id = htmlentities($_POST['id']);
    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $author = htmlentities($_POST['author']);
    $commentStatus = htmlentities($_POST['comment_status']);
    
    if($commentStatus != 0 && $commentStatus !=1){
        $commentStatus = 1;
    }

    if(!empty($_POST['current_featured_image']) && empty($_FILES['photo']['name'])){
        $image = htmlentities($_POST['current_featured_image']);
    }

    if(empty($title) || empty($content) || empty($author)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["image"] = $image;
        $_SESSION["author"] = $author;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }
    else{

        $update = new Post();
        
        //calling image upload function from image_upload.inc.php to upload the image
        if(!empty($_FILES['photo']['name'])){
            $image = imageUpload("addPost.php", "featured", "featured");
            $localpath = $image;
            $image = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $image));        //array to string conversion and getting relative path for image destination
    
            $unlink = $update->ReadSinglePost('post_id', $id);
            
            $result = $unlink->fetch_assoc();
        
            if(!empty($result['post_featured_image'])  && file_exists($result['local_path'])){
                if(unlink($result['local_path']) == FALSE){
                    $_SESSION["msg"] = "Media Deletion Error!!!";
                    $_SESSION["class"] = "danger";
                    
                    header("Location: ../view/postlist.php");
                    exit;
                }
            }
        }

    
        $result = $update->UpdatePost($id, $title, $content, $image, $author, $localpath, $commentStatus);

        if($result == 0){
            $_SESSION['msg'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/updatePost.php?id=$id");
            exit;
        }
        else{
            $_SESSION['msg'] = "Post Updated Successfully";
            $_SESSION['class'] = "success";
            header("Location: ../view/PostDetail.php?id=$id");
            exit;
        }
    }

}

//Update Draft Section
elseif(isset($_POST['updatedraft'])){

    $id = htmlentities($_POST['id']);
    $title = htmlentities($_POST['title']);
    $content = $_POST['content'];
    $author = htmlentities($_POST['author']);
    $commentStatus = htmlentities($_POST['comment_status']);
    
    if($commentStatus != 0 && $commentStatus !=1){
        $commentStatus = 1;
    }

    if(!empty($_POST['current_featured_image']) && empty($_FILES['photo']['name'])){
        $image = htmlentities($_POST['current_featured_image']);
    }

    if(empty($title) || empty($content) || empty($author)){

        $_SESSION["title"] = $title;
        $_SESSION["content"] = $content;
        $_SESSION["image"] = $image;
        $_SESSION["author"] = $author;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }
    else{

        $update = new Post();
        
        //calling image upload function from image_upload.inc.php to upload the image
        if(!empty($_FILES['photo']['name'])){
            $image = imageUpload("addPost.php", "featured", "featured");
            $localpath = $image;
            $image = implode(explode("public/", ROOT_URL_WEBSITE)) .  implode(explode('../', $image));        //array to string conversion and getting relative path for image destination
    
            $unlink = $update->ReadSinglePost('post_id', $id);
            
            $result = $unlink->fetch_assoc();
        
            if(!empty($result['post_featured_image'])  && file_exists($result['local_path'])){
                if(unlink($result['local_path']) == FALSE){
                    $_SESSION["msg"] = "Media Deletion Error!!!";
                    $_SESSION["class"] = "danger";
                    
                    header("Location: ../view/postlist.php");
                    exit;
                }
            }
        }

    
        $result = $update->UpdatePostDraft($id, $title, $content, $image, $author, $localpath, $commentStatus);

        if($result == 0){
            $_SESSION['msg'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/updatePost.php?id=$id");
            exit;
        }
        else{
            $_SESSION['msg'] = "Draft Saved Successfully";
            $_SESSION['class'] = "success";
            header("Location: ../view/PostDetail.php?id=$id");
            exit;
        }
    }

}


//Remove Featured Image
elseif(isset($_GET['remove_featured'])){
    $id = $_GET['remove_featured'];

    $remove_fetured_image = new Post();

    $unlink = $remove_fetured_image->ReadSinglePost('post_id', $id);
    
    $result = $unlink->fetch_assoc();

    if(!empty($result['post_featured_image'])  && file_exists($result['local_path'])){
        if(unlink($result['local_path']) == FALSE){
            $_SESSION["msg"] = "Media Deletion Error!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/postdetail.php?id=$id");
            exit;
        }
    }

    $result = $remove_fetured_image->RemoveFeatured($id);
    
    if($result == 0){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/updatePost.php?id=$id");
        exit;
    }
    else{
        $_SESSION['msg'] = "Post Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: ../view/PostDetail.php?id=$id");
        exit;
    }
}


//Delete Section
elseif(isset($_GET['delete'])){

    $id = $_GET['delete'];
    
    $delete = new Post();

    $unlink = $delete->ReadSinglePost('post_id', $id);
    
    $result = $unlink->fetch_assoc();

    if(!empty($result['post_featured_image'])  && file_exists($result['local_path'])){
        if(unlink($result['local_path']) == FALSE){
            $_SESSION["msg"] = "Media Deletion Error!!!";
            $_SESSION["class"] = "danger";
            
            header("Location: ../view/postlist.php");
            exit;
        }
    }

    $result = $delete->DeletePost($id);

    if($result == 0){
        $_SESSION["msg"] = "SQL Error Occured!!!";
        $_SESSION["class"] = "danger";

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION["msg"] = "Post Deleted Successfully!!!";
        $_SESSION["class"] = "success";

        header("Location: ../view/postlist.php");
        exit;
    }

}

else{
    header("Location: ../");
    exit;
}
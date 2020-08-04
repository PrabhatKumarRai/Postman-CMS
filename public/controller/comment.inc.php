<?php
session_start();

include_once __DIR__.'/../model/comment.class.php';
include_once __DIR__.'/../model/website_setting.class.php';

$websitetheme = new Website_setting();
$result = $websitetheme->GetWebsiteSetting();
$row = $result->fetch_assoc();
$theme = $row['theme'];

//Comment Section
if(isset($_POST['comment'])){
    $post_id = htmlentities($_POST['post_id']);
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $newComment = htmlentities($_POST['newcomment']);

    if(empty($post_id) || empty($name) || empty($email) || empty($newComment)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/$theme/postDetail.php?id=$post_id&name=$name&email=$email&comment=$newComment");
        exit;
    }
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/$theme/postDetail.php?id=$post_id&name=$name&email=$email&comment=$newComment");
        exit;
    }

    $comment = new Comment();
    $result = $comment->SetComment($post_id, $name, $email, $newComment);

    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/$theme/postDetail.php?id=$post_id&name=$name&email=$email&comment=$newComment");
        exit;
    }
    else{
        $_SESSION['msg'] = "Commented Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/$theme/postDetail.php?id=$post_id");
        exit;
    }

}

//Reply Section
elseif(isset($_POST['reply'])){
    $post_id = htmlentities($_POST['post_id']);
    $comment_id = htmlentities($_POST['c_id']);
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $newreply = htmlentities($_POST['newreply']);

    if(empty($comment_id) || empty($name) || empty($email) || empty($newreply)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/$theme/postDetail.php?id=$post_id&name=$name&email=$email&comment=$newreply");
        exit;
    }
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/$theme/postDetail.php?id=$post_id&name=$name&email=$email&comment=$newreply");
        exit;
    }

    $comment = new Comment();
    $result = $comment->SetReply($comment_id, $name, $email, $newreply);

    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/$theme/postDetail.php?id=$post_id&name=$name&email=$email&comment=$newreply");
        exit;
    }
    else{
        $_SESSION['msg'] = "Replied Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/$theme/postDetail.php?id=$post_id");
        exit;
    }

}

else{
    header("Location: ../");
}
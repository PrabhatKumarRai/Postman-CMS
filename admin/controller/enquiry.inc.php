<?php

session_start();

include_once __DIR__.'/../model/enquiry.class.php';

//Send Reply Section
if(isset($_POST['send'])){
    $id = htmlentities($_POST['enquiry-id']);
    $email = htmlentities($_POST['enquiry-email']);
    $subject = htmlentities($_POST['enquiry-subject']);
    $reply = htmlentities($_POST['enquiry-reply']);

    if(empty($reply)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $enquiry = new Enquiry();
    $result = $enquiry->UpdateReply($id, $reply);
    if($result == 1){
        echo "<script> window.open('https://mail.google.com/mail/u/0/?view=cm&fs=1&to=$email&tf=1&su=Response:$subject&body=$reply'); </script>";
        $_SESSION['msg'] = "Reply Updated Successfully!!!";
        $_SESSION['class'] = "success";
        echo "<script> location.assign('" . $_SERVER['HTTP_REFERER'] . "'); </script>";
        exit;
    }
    else{
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    
    
}

//Remove Enquiry Section
elseif(isset($_POST['delete'])){
    $id = $_POST['delete-id'];

    $delete = new Enquiry();
    $result = $delete->DeleteEnquiry($id);

    if($result == 1){
        $_SESSION['msg'] = "Enquiry Deleted Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Remove Reply Section
elseif(isset($_POST['delete-reply'])){
    
    $id = $_POST['id'];

    $RemoveReply = new Enquiry();
    $result = $RemoveReply->RemoveReply($id);

    if($result == 1){
        $_SESSION['msg'] = "Reply Deleted Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

else{
    header("Location: ../view/");
    exit;
}
<?php

    session_start();

    include_once  __DIR__.'/../../config/config.php';

    //Expire the session if user is inactive for 3000 Minutes
    //Expiry time is updated whenever the user changes any page or save/updates/deletes any data.
    $expireAfter = 3000;  //Minutes

    //Check if our "last action" session variable has been set.
    if(isset($_SESSION['last_action'])){

        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];

        //Convert our minutes into seconds.
        $expireAfterSeconds = $expireAfter * 60;

        //Check to see if they have been inactive for too long.
        if($secondsInactive >= $expireAfterSeconds){
            //User has been inactive for too long.
            //Kill their session.
            session_unset();
            session_destroy();
            header("Location: ../");
            exit;
        }

    }
    else{
    //If last_action is not set then distroy the session and send the user back to the login page.
      session_unset();
      session_destroy();
      header("Location: ../");
      exit;
    }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTMAN - Admin Panel</title>
    <link rel="icon" href="../../uploads/app/logo.png" type="image/gif" sizes="16x16">
    
    <!---------- Dependencies Section Starts ---------->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../includes/bootstrap/css/bootstrap.min.css">
    <script src="../includes/js/jquery.min.js"></script>
    <script src="../includes/bootstrap/js/bootstrap.min.js"></script>        
    <!-- CK EDITOR Section Starts -->
        <script src="<?= ROOT_URL_ADMIN ?>includes/ckeditor/ckeditor.js"></script>
    <!-- CK EDITOR Section Starts -->                
    <!---------- Dependencies Section Ends ---------->
    
    <!-- Custom CSS Starts -->
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/layout.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/common.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/post.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/searchpage.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/alert.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/admintheme.php">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/pages.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/about.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/gallery.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/enquiry.css">
    <link rel="stylesheet" href="<?= ROOT_URL_ADMIN ?>includes/css/index.css">
    <!-- Custom CSS Ends -->
    
    <!-- Custom JS Starts -->
    <script src="<?= ROOT_URL_ADMIN ?>includes/js/script.js"></script>
    <script src="<?= ROOT_URL_ADMIN ?>includes/js/script.php"></script>
    <!-- Custom JS Ends -->
    
</head>
<body class="bg-light">

<div class="d-flex justify-content-between flex-wrap">
    <!-- Including Navbar -->
    <?php include_once 'navbar.php'; ?>

    <div class="content pb-2" id="content">
        <div class="content-inner">
    
        <div class="mobile-block mb-4">
            <button class="sidebar-toggler-btn btn btn-light border" id="toggle" onclick="toggleNav()">Toggle Sidebar</button>
            <hr>
        </div>
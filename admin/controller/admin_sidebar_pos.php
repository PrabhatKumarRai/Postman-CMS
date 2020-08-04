<?php

session_start();

include_once __DIR__.'/../model/admintheme.class.php';

if(isset($_POST['sidebarpos'])){
    $position =  $_POST['sidebarpos'];

    $sidebarpos = new Admintheme();

    if($position == "pos1"){
        $position = "left";

    }
    elseif($position == "pos2"){
        $position = "right";
    }
    else{
        header("Location: ../index.php");
        exit;
    }

    $result = $sidebarpos->SetSidebarPos($position);

    
    if($result == 0){
        $_SESSION['msg'] = "SQL Error Occured !!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/settings.php");
        exit;
    }
    else{
        $_SESSION['msg'] = "Theme Updated Successfully !!";
        $_SESSION['class'] = "success";
        header("Location: ../view/settings.php");
        exit;
    }
}
else{
    header("Location: ../view");
    exit;
}
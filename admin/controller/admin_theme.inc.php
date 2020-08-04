<?php

session_start();

if(!isset($_GET['theme'])){
    header("Location: ../index.php");
    exit;
}

include_once __DIR__.'/../model/admintheme.class.php';

$theme = new Admintheme();

$sidebarbg = $_GET['theme'];

switch($sidebarbg){
    case 1: $result = $theme->UpdateAdminTheme("dark", "#111"); break;
    case 2: $result = $theme->UpdateAdminTheme("cyan", "#396c77"); break;
    case 3: $result = $theme->UpdateAdminTheme("grey", "#777777"); break;
    case 4: $result = $theme->UpdateAdminTheme("red", "#a73d3d"); break;
    case 5: $result = $theme->UpdateAdminTheme("green", "#2f7950"); break;
    default: $result = $theme->UpdateAdminTheme("dark", "#27292b");
}

if($result == '0'){
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

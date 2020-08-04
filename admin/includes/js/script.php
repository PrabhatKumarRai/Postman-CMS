<?php
    header("Content-type: text/javascript");
    
    include_once '../../model/admintheme.class.php';
    $sidebarpos = new Admintheme();
    $result = $sidebarpos->ReadAdminTheme();
    if($result == '' || $result == '0'){
        $sidebarPosition = "left";
    }
    else{
        $row = $result->fetch_assoc();
        $sidebarPosition = $row['sidebar_position'];
    }
    
?>

//Toggle Admin Sidebar
 function toggleNav(){                
    if(document.getElementById("sidebar-nav").style.<?= $sidebarPosition; ?> == "0px"){
        document.getElementById("sidebar-nav").style.<?= $sidebarPosition; ?> = "-280px";
    }
    else{
        document.getElementById("sidebar-nav").style.<?= $sidebarPosition; ?> = "0px";
    }
}
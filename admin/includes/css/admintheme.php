<?php
    header("Content-type: text/css;");

    include_once '../../model/admintheme.class.php';

    $theme = new Admintheme();
    $result = $theme->ReadAdminTheme();

    if($result == '' || $result == '0'){
        $sidebarBg = "#111";
        $sidebarPosition = "left";
        $sidebarunset = "left";
        $sidebarright = "unset";
    }
    else{
        $row = $result->fetch_assoc();
        
        $sidebarBg = $row['sidebarbg'];
        $sidebarPosition = $row['sidebar_position'];

        if($sidebarPosition == "left"){
            $sidebarunset = "right";
        }
        else{
            $sidebarunset = "left";
        }
    }
?>
/*-- ------------------------xx----------------------- */

/***** Content Section Starts *****/
.content{
    margin-<?= $sidebarPosition; ?>: auto;
}
/***** Content Section Ends *****/


/**** Side Bar Section Starts *****/
.sidebar-nav{
    background-color: <?= $sidebarBg; ?>;
    <?= $sidebarPosition; ?>: 0px;
}
@media(max-width: 768px){
    .sidebar-nav{
    <?= $sidebarPosition; ?>: -280px;
    <?= $sidebarunset; ?>: unset;
}
}
/**** Side Bar Section Ends *****/


/********* Alert Box Section Starts *********/
.alert-dismissible{
    <?= $sidebarunset; ?>: 5px;
}
/********* Alert Box Section Ends *********/


/***** All Theme Buttons For Settings Page *****/
.admin-theme-1, .admin-theme-2, .admin-theme-3, .admin-theme-4, .admin-theme-5{
    width: 68px;
}
.admin-theme-1{
    background-color: #27292b;
}
.admin-theme-2{
    background-color: #396c77;
}
.admin-theme-3{
    background-color: #777777;
}
.admin-theme-4{
    background-color: #a73d3d;
}
.admin-theme-5{
    background-color: #2f7950;
}
/*All Theme Buttons Section Ends*/

/*Index Page Cards Section Starts*/
.index-card{
    background-color: <?= $sidebarBg; ?>;
}
/*Index Page Cards Section Ends*/

/* Pages.php Cards Section Starts */
.pages-card{
    background-color: <?= $sidebarBg; ?>;
}
/* Pages.php Cards Section Ends */

<?php
    header("Content-type: text/css;");

    include_once '../../../../model/website_setting.class.php';

    $websiteSetting = new Website_setting();
    $result = $websiteSetting->GetWebsiteSetting();
    $row = $result->fetch_assoc();

    if($row == '' || $row == '0'){
        $themecolor = "#111";
    }
    else{
        $themecolor = $row['theme_color'];
    }
?>

/* ------------ Sidebar Setion Starts ------------ */
.sidebar-nav{
    background-color: <?= $themecolor ?>;
}
/* ------------ Sidebar Setion Ends ------------ */


/* -------  Pages.php Cards Section Starts  ------- */
.pages-card{
    background-color: <?= $themecolor; ?>;
}
/* -------  Pages.php Cards Section Ends  ------- */


/* ------------ Footer Setion Starts ------------ */
footer{
  background-color: <?= $themecolor ?>;
}
/* ------------ Footer Setion Ends ------------ */

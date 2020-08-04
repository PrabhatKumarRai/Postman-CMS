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

/* ------------ Navigation Setion Starts ------------ */
.navbar{
    background-color: <?= $themecolor ?>;
}
/* ------------ Navigation Setion Ends ------------ */

/* ------------ Footer Setion Starts ------------ */
footer{
  background-color: <?= $themecolor ?>;
}
/* ------------ Footer Setion Ends ------------ */

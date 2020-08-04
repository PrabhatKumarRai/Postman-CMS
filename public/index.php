<?php

    include_once 'model/website_setting.class.php';

    $theme = new Website_setting();
    $result = $theme->GetWebsiteSetting();
    $row = $result->fetch_assoc();

    header("Location: view/" . $row['theme'] . "/");

?>
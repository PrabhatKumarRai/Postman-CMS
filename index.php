<?php

    if(!file_exists('config/config.php')){
        //After config file creation, user will be automatically redirected to step 2 for Signup Process
        header("Location: setup/index.php?step=1");
        exit;
    }
    else{
        header("Location: public/");
    }

?>

<?php

session_start();

include_once __DIR__.'/../model/setup.class.php';

//************ Stage 1 ************//
//Database Creation
if(isset($_POST['dbSet'])){
    $timezone = trim(htmlentities($_POST['timezone']));
    $hostname = trim(htmlentities($_POST['hostname']));
    $dbname = trim(htmlentities($_POST['dbname']));
    $username = trim(htmlentities($_POST['username']));
    $password = trim(htmlentities($_POST['password']));

    if(empty($timezone) || empty($hostname) || empty($dbname) || empty($username)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";

        $_SESSION['dbname'] = $dbname;
        $_SESSION['hostname'] = $hostname;
        $_SESSION['username'] = $username;

        header("Location: ../index.php?step=1");
        exit;
    }
    else{

        //Database Name Check
        if(preg_match("/^[^\\/?%*:|\"<>.]{1,64}$/", $dbname) == 0){
            $_SESSION['msg'] = "Invalid Database Name!!!";
            $_SESSION['class'] = "danger";
    
            $_SESSION['dbname'] = $dbname;
            $_SESSION['hostname'] = $hostname;
            $_SESSION['username'] = $username;
    
            header("Location: ../index.php?step=1");
            exit;
        }

        $Setup = new Setup($hostname, $username, $password);
        
        
        //********** Database & Tables & Config File Creation Section Starts **********/
        $result = $Setup->CreateDatabase($dbname);
    
        if($result == 0){
            $_SESSION['msg'] = "Database Creation Error, Try Different Database Name!!!";
            $_SESSION['class'] = "danger";
    
            $_SESSION['dbname'] = $dbname;
            $_SESSION['hostname'] = $hostname;
            $_SESSION['username'] = $username;
    
            header("Location: ../index.php?step=1");
            exit;
        }
        else{        
            //************Config File Creation Starts************//
                //Creating Root URL Admin and Website Section Starts
                $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $current_link = substr($current_link, 0, strpos($current_link, "setup"));
                $rootUrlAdmin = $current_link . "admin/";
                $rootUrlWebsite = $current_link . "public/";
                //Creating Root URL Admin and Website Section Ends
                
                //Main Contents Format of Config File
                $content = "<?php \n\n\n// Default Time Zone \n date_default_timezone_set('$timezone'); \n\n\n//*************Database Configuration Setting Starts*************// \n//Database Name\ndefine('DEFAULT_DB_NAME', '$dbname'); \n\n//User Name\ndefine('DEFAULT_USER_NAME', '$username'); \n\n//Password\ndefine('DEFAULT_PASSWORD', '$password'); \n\n//Host Name\ndefine('DEFAULT_HOST_NAME', '$hostname'); \n\n//*************Database Configuration Setting Ends*************// \n\n\n//*************Root Path Setting Starts*************// \n// Base URL ADMIN \ndefine('ROOT_URL_ADMIN', '$rootUrlAdmin'); \n\n// Base URL WEBSITE \ndefine('ROOT_URL_WEBSITE', '$rootUrlWebsite'); \n\n//*************Root Path Setting Ends*************// \n\n";
                
                $handle = fopen('../../config/config.php', 'w') or die("Config File Creation Error!!!");
                fwrite($handle, $content);
                //************Config File Creation Ends************//  
        
            //********** Database & Tables & Config File Creation Section Ends **********/
            
            $_SESSION['msg'] = "Stage 1 Completed!!!";
            $_SESSION['class'] = "success";
            header("Location: ../index.php?step=2");
            exit;
        }
    }

}

//************ Stage 2 ************//
//User Creation
elseif(isset($_POST['userset'])){

    if(!file_exists("../../config/config.php")){
        $_SESSION['msg'] = "Stage 1 Not Completed!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../index.php?step=1");
        exit;
    }
    else{
        include_once __DIR__."/../../config/config.php";
    }

    $name = htmlentities($_POST['name']);
    $designation = htmlentities($_POST['designation']);
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    $passwordconfirm = htmlentities($_POST['passwordconfirm']);

    //Empty
    if(empty($name) || empty($designation) || empty($username) || empty($password)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";

        $_SESSION['name'] = $name;
        $_SESSION['designation'] = $designation;
        $_SESSION['username'] = $username;
        header("Location: ../index.php?step=2");
        exit;
    }
    else{

        //Password Comparison
        if(strcmp($password, $passwordconfirm) !== 0){
            $_SESSION['msg'] = "Password and Confirm Password do not match!!!";
            $_SESSION['class'] = "danger";

            $_SESSION['name'] = $name;
            $_SESSION['designation'] = $designation;
            $_SESSION['username'] = $username;
            header("Location: ../index.php?step=2");
            exit;
        }
        else{

            //Length
            if(strlen($username) < 5 || strlen($password) < 8){
                $_SESSION['msg'] = "Username must be atleast 5 characters and password must be atleast 8 characters long!!!";
                $_SESSION['class'] = "danger";
    
                $_SESSION['name'] = $name;
                $_SESSION['designation'] = $designation;
                $_SESSION['username'] = $username;
                header("Location: ../index.php?step=2");
                exit;
            }
            else{
    
                //Password Character Validation
                if(preg_match("/[a-z]/", $password) == 0 || preg_match("/[A-Z]/", $password) == 0 || preg_match("/[0-9]/", $password) == 0 || preg_match("/[!@#$%]/", $password) == 0){     //must contain atleast 1 lower case, 1 upper case, 1 digit and 1 symbol
                    $_SESSION['msg'] = "Password must contain atleast 1 lower case character, 1 upper case character, 1 digit and 1 special symbol!!!";
                    $_SESSION['class'] = "danger";
    
                    $_SESSION['name'] = $name;
                    $_SESSION['designation'] = $designation;
                    $_SESSION['username'] = $username;
                    header("Location: ../index.php?step=2");
                    exit;
                }
                else{
                    //Hashing Password
                    $password = password_hash($password, PASSWORD_BCRYPT);

                    $user = new Setup(DEFAULT_HOST_NAME, DEFAULT_USER_NAME, DEFAULT_PASSWORD);
                    $result = $user->CreateUser(DEFAULT_HOST_NAME, DEFAULT_USER_NAME, DEFAULT_PASSWORD, DEFAULT_DB_NAME, $name, $designation, $username, $password);

                    if($result == 0){
                        $_SESSION['msg'] = "SQL Error Occured, Check Your Server and Database!!!";
                        $_SESSION['class'] = "danger";
        
                        $_SESSION['name'] = $name;
                        $_SESSION['designation'] = $designation;
                        $_SESSION['username'] = $username;

                        header("Location: ../index.php?step=2");
                        exit;
                    }
                    else{
                        $_SESSION['msg'] = "Postman Setup Completed Successfully!!!";
                        $_SESSION['class'] = "success";

                        header("Location: ../../admin/");
                        exit;
                    }
                }
            }
        }
    }

}

else{
    header("Location: ../../");
}

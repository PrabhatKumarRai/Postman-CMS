<?php

session_start();

include_once __DIR__.'/../model/users.class.php';

//Login Section
if(isset($_POST['submit'])){

    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    if(empty($username) || empty($password)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        $_SESSION['username'] = $username;
        header("Location: ../index.php");
        exit;
    }
    else{

        $login = new Users();
        $result = $login->ReadSingleUser('u_uname', $username);
        
        if($result->num_rows < 1){            
            $_SESSION['msg'] = "Incorrect Username!!!";
            $_SESSION['class'] = "danger";
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
            exit;
        }
        else{
                        
            $row = $result->fetch_assoc();

            if(password_verify($password, $row['u_pass']) == FALSE){        //hashed password verify function
                $_SESSION['msg'] = "Incorrect Password!!!";
                $_SESSION['class'] = "danger";
                $_SESSION['username'] = $username;
                header("Location: ../index.php");
                exit;
            }
            else{
                $_SESSION['u_id'] = $row['u_id'];
            
                $_SESSION['msg'] = "Login Successful!!!";
                $_SESSION['class'] = "success";
                print_r($_SESSION);
                header("Location: ../view/");
                exit;
            }
            
        }

    }

}

//Logout Section
elseif(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location: ../");
    exit;
}

else{
    header("Location: ../");
    exit;
}

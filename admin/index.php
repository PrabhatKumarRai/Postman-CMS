<?php
    session_start();

    if(!empty($_SESSION['u_id'])){
        header("Location: view/");
        exit;
    }

    //--------------Else Display the Login Page--------------//
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postman - Admin Login</title>
    <link rel="icon" href="../uploads/app/logo.png" type="image/gif" sizes="16x16">

    <!-- Dependencies Section Starts -->
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <script src="includes/js/jquery.min.js"></script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
    <!-- Dependencies Section Ends -->

    <!-- Auto Hide Alert Box Script Starts -->
    <script>
        $(document).ready (function(){
            $('.alert-dismissible').delay(3000).fadeOut();
        });
    </script>
    <!-- Auto Hide Alert Box Script Ends -->

    <style>
        body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
        }
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        /* #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        } */
        .alert-dismissible{
            position: fixed;
            top: 5px;
            right: 5px;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div id="login">
        
        <!-- Alert Section Starts -->
        <?php
            if(isset($_SESSION['msg'])){
        ?>
            <div class="alert alert-<?= $_SESSION['class']; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <span class="text-uppercase"><strong><?= $_SESSION['class']; ?>!</strong></span>
                <?= $_SESSION['msg']; ?>
            </div>
        <?php
            }
            unset($_SESSION['msg']);
            unset($_SESSION['class']);
        ?>
        <!-- Alert Section Ends -->


        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form action="controller/login.inc.php" method="POST" id="login-form" class="form">
                            <h3 class="text-center text-info">Admin Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" value="<?= (isset($_SESSION['username']))? $_SESSION['username']: ''; ?>" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <!-- <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                <button type="submit" class="btn btn-info btn-md px-4 rounded-0" name="submit">Submit</button>
                            </div>
                            <div id="register-link" class="text-right">
                                <!-- <a href="#" class="text-info">Register here</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php session_unset(); ?>
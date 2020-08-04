<?php
    session_start();

    if(!isset($_GET['step'])){
        header("Location: ../");
        exit;
    }

    include_once __DIR__.'/model/setup.class.php';

    if(file_exists("../config/config.php")){
        include_once __DIR__."/../config/config.php";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postman - Initial Setup</title>
    <link rel="icon" href="../uploads/app/logo.png" type="image/gif" sizes="16x16">

    <!-- Dependencies Section Starts -->
    <link rel="stylesheet" href="../admin/includes/bootstrap/css/bootstrap.min.css">
    <script src="../admin/includes/js/jquery.min.js"></script>
    <script src="../admin/includes/bootstrap/js/bootstrap.min.js"></script>
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
            max-width: 600px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        #login-row{
            min-height: 100vh;
            padding: 50px 0px;
        }

        /* Alert Section */
        .alert-dismissible{
            position: fixed;
            top: 5px;
            right: 5px;
            z-index: 1;
        }
        .font-12{
            font-size: 12px;
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
            <div id="login-row" class="d-flex justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">

                        <?php if(isset($_GET['step'])){

                            $step = $_GET['step'];

                            switch($step){
                                case 1: 
                                    if(file_exists("../config/config.php")){
                                        header("Location: index.php?step=2");
                                        exit;
                                    }
                        ?>
                                
                                <form action="controller/setup.inc.php" method="POST" id="login-form" class="form">
                                    <h3 class="text-center text-info">Postman Setup</h3>
                                    <h5 class="text-center text-info">Stage - 1 of 2</h5>
                                    <!-- Timezone Starts -->
                                    <div class="form-group">
                                        <label class="text-info">Timezone:</label><br>
                                        <select name="timezone" class="custom-select mb-3" required>
                                            <?php 
                                                foreach(timezone_identifiers_list() as $index => $value){ 
                                                    if($value == "Asia/Kolkata"){
                                            ?>
                                            <option value="<?= $value; ?>" selected><?= $value; ?></option>
                                            <?php
                                                    }else{
                                            ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Timezone Ends -->
                                    <hr>
                                    <!-- Database Name -->
                                    <div class="form-group">
                                        <label class="text-info">Database Name:</label><br>
                                        <input type="text" name="dbname" class="form-control" value="<?= (isset($_SESSION['dbname']))? $_SESSION['dbname']: ''; ?>" >
                                    </div>
                                    <!-- Host Name -->
                                    <div class="form-group">
                                        <label class="text-info">Server Host Name:</label><br>
                                        <input type="text" name="hostname" class="form-control" value="<?= (isset($_SESSION['hostname']))? $_SESSION['hostname']: ''; ?>" >
                                    </div>
                                    <!-- Username -->
                                    <div class="form-group">
                                        <label class="text-info">Server Username:</label><br>
                                        <input type="text" name="username" class="form-control" value="<?= (isset($_SESSION['username']))? $_SESSION['username']: ''; ?>" >
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group mb-4">
                                        <label class="text-info">Server Password: <span class="text-danger font-12">( Leave empty if no password is set for server )</span></label><br>
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                    <!-- Submit -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-md px-4 rounded-0" name="dbSet">Submit</button>
                                    </div>
                                </form>

                        <?php
                                break;
                                case 2: 
                                    //Checking if user exists then redirect to login page
                                    $user = new Setup(DEFAULT_HOST_NAME, DEFAULT_USER_NAME, DEFAULT_PASSWORD);
                                    $result = $user->GetUser(DEFAULT_HOST_NAME, DEFAULT_USER_NAME, DEFAULT_PASSWORD, DEFAULT_DB_NAME);
                                    if($result != '0' && $result != '2'){
                                        header("Location: ../admin/");
                                        exit;
                                    }
                        ?>
                                
                                <form action="controller/setup.inc.php" method="POST" id="login-form" class="form">
                                    <h3 class="text-center text-info">Postman Setup</h3>
                                    <h5 class="text-center text-info">Stage - 2 of 2</h5>
                                    <div class="form-group">
                                        <label for="name" class="text-info">Name:</label><br>
                                        <input type="text" name="name" id="name" class="form-control" value="<?= (isset($_SESSION['name']))? $_SESSION['name']: ''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="designation" class="text-info">Profession:</label><br>
                                        <input type="text" name="designation" id="designation" class="form-control" value="<?= (isset($_SESSION['designation']))? $_SESSION['designation']: ''; ?>" required>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="username" class="text-info">Username:</label><br>
                                        <input type="text" name="username" id="username" class="form-control" value="<?= (isset($_SESSION['username']))? $_SESSION['username']: ''; ?>" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password" class="text-info">Password:</label><br>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="passwordconfirm" class="text-info">Confirm Password:</label><br>
                                        <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-md px-4 rounded-0" name="userset">Submit</button>
                                    </div>
                                </form>

                        <?php 

                                break;
                                default: 
                        ?>                            
                                <h3 class="text-center text-info">Postman Setup</h3>
                                <h5 class="text-center text-info">Setup Completed</h5>
                        <?php
                                ;
                            }

                        }else{
                            header("Location: ../index.php");
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php session_unset(); ?>
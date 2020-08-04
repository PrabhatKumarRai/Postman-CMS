<?php 
    include_once __DIR__.'/../includes/header.php';

    include_once __DIR__.'/../model/users.class.php';
    include_once __DIR__.'/../model/admintheme.class.php';

    include_once __DIR__.'/alert.php';
?>


<?php

    $readobj = new Users();
    $result= $readobj->ReadSingleUser('u_id', 1);

    if($result == ''){
?>
        <div class="search-links-container">
            <div class="search-links-inner text-center py-3">
                <h4>User Not Found !!!</h4>
            </div>
        </div>
<?php
    }
    elseif($result == '0'){
?>
        <div class="search-links-container">
            <div class="search-links-inner text-center py-3">
                <h4>SQL Error Occured !!!</h4>
            </div>
        </div>
<?php
    }
    else{
        
    $row = $result->fetch_assoc();
?>

<div class="accordion" id="postman-settings">


    <!-- Website Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-website-body" aria-expanded="true" aria-controls="setting-admin-theme-body">
            <div class="card-header py-3" id="setting-website-setting">
                Website
            </div>
        </a>

        <div id="setting-website-body" class="collapse" aria-labelledby="setting-website-setting" data-parent="#postman-settings">            
            <div class="card-body">
                <p class="mb-2 font-weight-500 mb-3">Theme : </p>
                <div class="settings-inner d-flex justify-content-start align-items-center flex-wrap mb-2">
                    <a href="../controller/website_setting.inc.php?theme=1" class="btn btn-primary border-0 mb-3 mr-3">Theme-1</a>
                    <a href="../controller/website_setting.inc.php?theme=2" class="btn btn-primary border-0 mb-3 mr-3">Theme-2</a>
                    <a href="../controller/website_setting.inc.php?theme=3" class="btn btn-primary border-0 mb-3 mr-3">Theme-3</a>
                </div>
                <p class="mb-2 font-weight-500">Theme Color : </p>
                <div class="settings-inner d-flex justify-content-start align-items-center flex-wrap">
                    <a href="../controller/website_setting.inc.php?themeColor=1" class="admin-theme-1 btn btn-dark border-0 mb-3 mr-3">Dark</a>
                    <a href="../controller/website_setting.inc.php?themeColor=2" class="admin-theme-2 btn btn-info border-0 mb-3 mr-3">Cyan</a>
                    <a href="../controller/website_setting.inc.php?themeColor=3" class="admin-theme-3 btn btn-secondary border-0 mb-3 mr-3">Grey</a>
                    <a href="../controller/website_setting.inc.php?themeColor=4" class="admin-theme-4 btn btn-danger border-0 mb-3 mr-3">Red</a>
                    <a href="../controller/website_setting.inc.php?themeColor=5" class="admin-theme-5 btn btn-success border-0 mb-3 mr-3">Green</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Panel Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-admin-theme-body" aria-expanded="true" aria-controls="setting-admin-theme-body">
            <div class="card-header py-3" id="setting-admin-theme-head">
                Admin Panel
            </div>
        </a>
        <div id="setting-admin-theme-body" class="collapse" aria-labelledby="setting-admin-theme-head" data-parent="#postman-settings">            
            <div class="card-body">
                <p class="mb-2 font-weight-500">Admin Panel Theme :</p>
                <div class="settings-inner d-flex justify-content-start align-items-center flex-wrap mb-2">
                    <a href="../controller/admin_theme.inc.php?theme=1" class="admin-theme-1 btn btn-dark border-0 mb-3 mr-3">Dark</a>
                    <a href="../controller/admin_theme.inc.php?theme=2" class="admin-theme-2 btn btn-info border-0 mb-3 mr-3">Cyan</a>
                    <a href="../controller/admin_theme.inc.php?theme=3" class="admin-theme-3 btn btn-secondary border-0 mb-3 mr-3">Grey</a>
                    <a href="../controller/admin_theme.inc.php?theme=4" class="admin-theme-4 btn btn-danger border-0 mb-3 mr-3">Red</a>
                    <a href="../controller/admin_theme.inc.php?theme=5" class="admin-theme-5 btn btn-success border-0 mb-3 mr-3">Green</a>
                </div>
                
                <div class="mt-2">

                    <?php
                    
                        $sidebarpos = new Admintheme();
                        $resultpos = $sidebarpos->GetSidebarPos();
                        $rows = $resultpos->fetch_assoc();

                    ?>

                    <form action="../controller/admin_sidebar_pos.php" method="POST">
                        <span class="mr-3 font-weight-500">Sidebar Position : </span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sidebarpos" id="sidebarleft" onchange="this.form.submit();this.checked=true;" value="pos1" <?= ($rows['sidebar_position'] == "left") ? "checked" : ''; ?>>
                            <label class="form-check-label" for="sidebarleft">Left</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sidebarpos" id="sidebarright" onchange="this.form.submit();this.checked=true;" value="pos2" <?= ($rows['sidebar_position'] == "right") ? "checked" : ''; ?>>
                            <label class="form-check-label" for="sidebarright">Right</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-account-body" aria-expanded="true" aria-controls="setting-account-body">
            <div class="card-header py-3" id="setting-account-head">
                Account
            </div>
        </a>
        <div id="setting-account-body" class="collapse" aria-labelledby="setting-account-head" data-parent="#postman-settings">
            <div class="card-body">
                    <div class="settings-inner">
                            <div>
                                <form action="../controller/users.inc.php?update=1" method="POST" enctype="multipart/form-data">
                                    <!-- For User ID -->
                                    <input type="hidden" name="id" value="<?= $row['u_id']; ?>">

                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="title">Name<span class="text-danger">*</span> : </label>
                                        <input type="text" class="form-control" name="name" value="<?php echo ($row['u_name']) ? $row['u_name'] : ''; ?>" required>
                                    </div>
                                    <!-- Designation -->
                                    <div class="form-group">
                                        <label for="title">Profession<span class="text-danger">*</span> : </label>
                                        <input type="text" class="form-control" name="designation" value="<?php echo ($row['u_designation']) ? $row['u_designation'] : ''; ?>" required>
                                    </div>
                                    <!-- Mobile & DOB -->
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="mb-3">
                                            <label for="content">DOB : </label>
                                            <input type="date" class="form-control" name="dob" value="<?php echo ($row['u_dob']) ? $row['u_dob'] : ''; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content">Mobile : </label>
                                            <input type="number" class="form-control" name="mobile" value="<?php echo ($row['u_mobile']) ? $row['u_mobile'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- About -->
                                    <div class="mb-3">
                                        <label for="content">About : </label> <span class="text-danger font-12">Do not use Single Quotes</span>
                                        <textarea class="form-control" name="about" rows="8"><?php echo ($row['u_about']) ? $row['u_about'] : '';  ?></textarea>
                                    </div>
                                    <!-- Image -->
                                    <div class="form-group">
                                        <label for="author">Profile Image : </label>
                                        <input type="hidden" name="current_photo" value="<?= ($row['u_image'])? $row['u_image']: ''; ?>">
                                        <input type="file" class="btn btn-block bg-white border" name="photo">
                                        <?php
                                            if($row['u_image']){
                                                echo "Current Image : " . $row['u_image'];
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary rounded-0 pl-5 pr-5">Update</button>
                                    <!-- Button trigger modal -->
                                    <a href="#" class='btn btn-danger px-1 m-0 rounded-0' data-toggle="modal" data-target="#removeProfileImageModal">Remove Image</a>
                                </form>

                                <!-- Remove Image Confirmation Modal Section Starts -->
                                <div class="modal fade" id="removeProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Remove Profile Image Confirmation</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h5>Are You Sure to Remove Profile Image ?</h5>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <a href="../controller/users.inc.php?remove_image=<?= $row['u_id']; ?>" class="btn btn-danger rounded-0">Remove</a>
                                            <button type="button" class="btn btn-primary rounded-0" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Remove Image Confirmation Modal Section End -->
                            </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Social Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-social-body" aria-expanded="false" aria-controls="setting-social-body">
            <div class="card-header py-3" id="setting-social-head">
                Social Media
            </div>
        </a>
        <div id="setting-social-body" class="collapse" aria-labelledby="setting-social-head" data-parent="#postman-settings">
            <form action="../controller/users.inc.php?update=2" method="POST">
                <div class="card-body">

                    <!-- For User ID -->
                    <input type="hidden" name="id" value="<?= $row['u_id']; ?>">

                    <!-- Facebook -->
                    <div class="form-group">
                        <label for="title">Facebook (Link) : </label>
                        <input type="url" class="form-control" name="facebook" value="<?php echo ($row['u_facebook']) ? $row['u_facebook'] : ''; ?>">
                    </div>

                    <!-- Twitter -->
                    <div class="form-group">
                        <label for="title">Twitter (Link) : </label>
                        <input type="url" class="form-control" name="twitter" value="<?php echo ($row['u_twitter']) ? $row['u_twitter'] : ''; ?>">
                    </div>
                    
                    <!-- Instagram -->
                    <div class="form-group">
                        <label for="title">Instagram (Link) : </label>
                        <input type="url" class="form-control" name="instagram" value="<?php echo ($row['u_instagram']) ? $row['u_instagram'] : ''; ?>">
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <label for="title">Email ID : </label>
                        <input type="email" class="form-control" name="email" value="<?php echo ($row['u_email']) ? $row['u_email'] : ''; ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary rounded-0 pl-5 pr-5">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Privacy Settings -->
    <div class="card">
        <a href="#" data-toggle="collapse" data-target="#setting-privacy-body" aria-expanded="false" aria-controls="setting-privacy-body">
            <div class="card-header py-3" id="setting-privacy-head">
                Privacy
            </div>
        </a>
        <div id="setting-privacy-body" class="collapse" aria-labelledby="setting-privacy-head" data-parent="#postman-settings">
            <form action="../controller/users.inc.php?update=3" method="POST" autocomplete="off">
                <div class="card-body">
                        
                        <!-- For User ID -->
                        <input type="hidden" name="id" value="<?= $row['u_id']; ?>">

                        <!-- Username -->
                        <div class="form-group">
                            <label for="title">Username : </label>
                            <input type="text" class="form-control" name="username" value="<?php echo ($row['u_uname']) ? $row['u_uname'] : ''; ?>" disabled>
                        </div>

                        <div class="text-secondary mt-4">
                            Change Password
                        </div>
                        <hr>
                        
                        <input type="password" class="autocomplete-off" style="display: none !important;" value="">
                        <!-- Old Password -->
                        <div class="form-group">
                            <label for="title">Enter Old Password : </label>
                            <input type="password" class="form-control autocomplete-off" name="old_pass" autocomplete="new-password" required>
                        </div>    
                        
                        <!-- New Password -->
                        <div class="form-group">
                            <label for="title">New Password : </label>
                            <input type="password" class="form-control autocomplete-off" name="new_pass" autocomplete="new-password" required>
                        </div>     
                        
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="title">Confirm Password : </label>
                            <input type="password" class="form-control autocomplete-off" name="confirm_pass" autocomplete="new-password" required>
                        </div>             
                        <button type="submit" name="submit" class="btn btn-primary rounded-0 pl-5 pr-5">Update</button>
                    </div>
                </div>
            </form>
    </div>
</div>

<?php
    }
?>

<?php include __DIR__.'/../includes/footer.php'; ?>
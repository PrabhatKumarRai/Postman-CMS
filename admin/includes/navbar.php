<?php 

include_once __DIR__.'/../model/users.class.php';

$navdata = new Users();
$result = $navdata->ReadSingleUser('u_id', 1);
if($result != '' && $result != '0'){
    $row = $result->fetch_assoc();
}

?>

<nav class="navbar sidebar-nav d-block px-1 py-0" id="sidebar-nav">
    <div class="sidebar-top">
        <a href="javascript:void(0)" class="closebtn mobile-block" onclick="toggleNav()">×</a>
        <div class="text-center text-white">
            <!-- User Image -->
            <div>
                <a href="<?= (!empty($row['u_image'])) ? $row['u_image'] : "../../uploads/app/dummy-profile-pic.jpg" ?>" target="_blank">
                    <div class="sidebar-user-image rounded-circle">
                        <img src="<?= (!empty($row['u_image'])) ? $row['u_image'] : "../../uploads/app/dummy-profile-pic.jpg" ?>" class="rounded-circle">
                    </div>
                </a>
            </div>
            <!-- User Name -->
            <div class="sidebar-user-name text-capitalize">
                <a href="<?= ROOT_URL_ADMIN; ?>view/"><?= $row['u_name']; ?></a>
            </div>
            <!-- User Designation -->
            <div class="sidebar-user-designation text-capitalize">
                <span><?= $row['u_designation']; ?></span>
            </div>
            <!-- User Social -->
            <div class="sidebar-user-social">
                <?php if(!empty($row['u_facebook'])){ ?>
                <a href="<?= $row['u_facebook']; ?>" target="_blank">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <?php } if(!empty($row['u_twitter'])){ ?>
                <a href="<?= $row['u_twitter']; ?>" target="_blank">
                    <i class="fab fa-twitter-square"></i>
                </a>
                <?php } if(!empty($row['u_instagram'])){ ?>
                <a href="<?= $row['u_instagram']; ?>" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <?php } if(!empty($row['u_email'])){ ?>
                <a href="mailto:<?= $row['u_email']; ?>" target="_blank">
                    <i class="fas fa-envelope"></i>
                </a>
                <?php } ?>
            </div>
        </div>
        <hr class="bg-lightblack">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/pages.php">Pages</a>
            </li>
            <li class="nav-item">                
                <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Posts
                </a>
                <div class="collapse p-2 border" id="collapseExample">
                    <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/postlist.php">Post List</a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/postdraft.php">Post Draft</a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/addpost.php">Create Post</a>
                </div>
            </li>            
            <li class="nav-item">                
                <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#sidebar-account-link" role="button" aria-expanded="false" aria-controls="sidebar-account-link">
                    Account
                </a>
                <div class="collapse p-2 border" id="sidebar-account-link">
                    <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>view/settings.php">Settings</a>
                    <div class="dropdown-divider"></div>
                    <!-- Logout Section -->
                    <form action="../controller/login.inc.php" method="POST">
                        <button class="btn btn-link nav-link p-0 text-white" name="logout">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
        <hr class="bg-lightblack">
        <!-- Search Box -->
        <div class="sidebar-search">
            <form action="searchPost.php" method="post">
                <input type="text" name="search" class="w-100 p-2 mb-1">
                <button type="submit" class="btn btn-dark btn-block rounded-0" name="submit">Go</button>
            </form>
        </div>
    </div>
    <div class="sidebar-bottom">
        <a href="<?= ROOT_URL_WEBSITE; ?>" class="sidebar-visit-website d-block text-decoration-none text-center text-dark" target="_blank">
            <h5 class="mb-0">Visit Website</h5>
        </a>
    </div>
</nav>
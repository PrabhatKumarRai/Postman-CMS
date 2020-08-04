<?php

include_once __DIR__.'/../../../model/users.class.php';

$navdata = new Users();
$result = $navdata->ReadSingleUser('u_id', 1);
$row = $result->fetch_assoc();

?>

<nav class="navbar sidebar-nav d-block px-1 py-0" id="sidebar-nav">
    <div class="sidebar-top">
        <a href="javascript:void(0)" class="closebtn mobile-block" onclick="toggleNav()">×</a>
        <div class="text-center text-white">
            <!-- User Image -->
            <div>
                <div class="sidebar-user-image rounded-circle">
                    <img src="<?= (!empty($row['u_image'])) ? $row['u_image'] : "../../../uploads/app/dummy-profile-pic.jpg" ?>" class="rounded-circle">
                </div>
            </div>
            <!-- User Name -->
            <div class="sidebar-user-name text-capitalize">
                <a href="index.php"><?= $row['u_name']; ?></a>
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
                <a class="nav-link" href="<?= ROOT_URL_WEBSITE; ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL_WEBSITE; ?>view/theme-1/pages.php">Pages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL_WEBSITE; ?>view/theme-1/postlist.php">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL_WEBSITE; ?>view/theme-1/contact.php">Contact</a>
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
        <a href="<?= ROOT_URL_ADMIN; ?>" class="sidebar-visit-website d-block text-decoration-none text-center text-dark" target="_blank">
            <h5 class="mb-0">Admin Login</h5>
        </a>
    </div>
</nav>

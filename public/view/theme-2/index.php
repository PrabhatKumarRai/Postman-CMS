<?php
    include_once __DIR__.'/../../model/users.class.php';

    include_once __DIR__.'/includes/header.php';
?>


<div class="index-container">


<div class="container-fluid">


<!-- About Me Section Starts -->
<?php
    $aboutMe = new Users();
    $result = $aboutMe->ReadSingleUser('u_id', 1);
    $row = $result->fetch_assoc();
?>
<div class="index-about-me-container text-center">
    <div class="about-content">
        <!-- Name -->
        <div class="about-content-name">
            <span class="text-uppercase"><?= $row['u_name']; ?></span>
        </div>
        <div class="index-hr"></div>
        <!-- Designation -->
        <div class="about-content-designation">
            <span class="text-capitalize"><?= $row['u_designation']; ?></span>
        </div>
        <!-- Social -->
        <div class="about-content-social">
            <?php if(!empty($row['u_facebook'])){ ?>
            <a href="<?= $row['u_facebook']; ?>" target="_blank" class="index-social-link">
                <i class="fab fa-facebook-square"></i>
            </a>
            <?php } if(!empty($row['u_twitter'])){ ?>
            <a href="<?= $row['u_twitter']; ?>" target="_blank" class="index-social-link">
                <i class="fab fa-twitter-square"></i>
            </a>
            <?php } if(!empty($row['u_instagram'])){ ?>
            <a href="<?= $row['u_instagram']; ?>" target="_blank" class="index-social-link">
                <i class="fab fa-instagram"></i>
            </a>
            <?php } if(!empty($row['u_email'])){ ?>
            <a href="mailto:<?= $row['u_email']; ?>" class="index-social-link">
                <i class="fas fa-envelope"></i>
            </a>
            <?php }  if(!empty($row['u_mobile'])){ ?>
            <a href="tel:<?= $row['u_mobile']; ?>" class="index-social-link">
                <i class="fas fa-phone-square"></i>
            </a>
            <?php } ?>
        </div>
        
        <!-- Search Box -->
        <div class="index-search">
            <div class="index-search-inner">
                <form action="searchPost.php" method="post">
                    <i class="fa fa-search"></i>
                    <input type="text" name="search" placeholder="Search" autocomplete="off">
                    <button type="submit" class="d-none btn btn-dark btn-block rounded-0" name="submit">Go</button>
                </form>
            </div>
        </div>

        <!-- Navigation Section -->
        <div class="index-nav-container">
            <a href="index.php" class="index-nav-link">Home</a>
            <a href="postlist.php" class="index-nav-link">Post</a>
            <a href="about.php" class="index-nav-link">About</a>
            <a href="contact.php" class="index-nav-link">Contact</a>
            <a href="gallery.php" class="index-nav-link">Gallery</a>
            <a href="contact.php" class="index-nav-link">Contact</a>
            <a href="<?= ROOT_URL_ADMIN; ?>" class="index-nav-link" target="_blank">Login</a>
        </div>
    </div>
</div>
<!-- About Me Section Ends -->

</div>



<?php include __DIR__.'/includes/footer.php'; ?>

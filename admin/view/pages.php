<?php 

include_once __DIR__.'/../includes/header.php';

?>

<div class="pages-card-container d-flex justify-content-around flex-wrap">
    
    <a href="<?= ROOT_URL_ADMIN ?>view/postlist.php">
        <div class="pages-card">
            Posts
        </div>
    </a>
    <a href="<?= ROOT_URL_ADMIN ?>view/about.php">
        <div class="pages-card">
            About
        </div>
    </a>
    <a href="<?= ROOT_URL_ADMIN ?>view/gallery.php">
        <div class="pages-card">
            Gallery
        </div>
    </a>
    <a href="<?= ROOT_URL_ADMIN ?>view/corausal.php">
        <div class="pages-card">
            Corausal
        </div>
    </a>
    <a href="<?= ROOT_URL_ADMIN ?>view/enquiry.php">
        <div class="pages-card">
            Enquiry
        </div>
    </a>


</div>

<?php include __DIR__.'/../includes/footer.php'; ?>
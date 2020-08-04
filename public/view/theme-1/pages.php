<?php

session_start();

include_once __DIR__.'/includes/header.php';

?>

<div class="pages-card-container d-flex justify-content-around flex-wrap">

    <a href="postlist.php">
        <div class="pages-card">
            Posts
        </div>
    </a>
    <a href="about.php">
        <div class="pages-card">
            About
        </div>
    </a>
    <a href="gallery.php">
        <div class="pages-card">
            Gallery
        </div>
    </a>


</div>

<?php include __DIR__.'/includes/footer.php'; ?>

<?php session_unset(); ?>

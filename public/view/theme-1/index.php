<?php
    include_once __DIR__.'/../../model/post.class.php';
    include_once __DIR__.'/../../model/corausal.class.php';
    include_once __DIR__.'/../../model/users.class.php';
    include_once __DIR__.'/../../model/gallery.class.php';

    include_once __DIR__.'/includes/header.php';
?>


<div class="index-container bg-white">

<!-- Corausal Section Starts -->
<?php
    $corausal = new Corausal();
    $result = $corausal->GetImage();
    $i = 0;



    if($result != '' || $result != 0){
?>
        <div id="index-corausal" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                while($row = $result->fetch_assoc()){
                ++$i;
                ?>
                <div class="carousel-item<?= ($i == 1)? ' active': ''; ?>">
                    <img class="d-block w-100" src="<?= $row['image']; ?>" alt="Corausal slide">
                </div>
                <?php
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#index-corausal" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#index-corausal" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
<?php
    }
?>
<!-- Corausal Section Ends -->

<div class="container-fluid">

<!-- Latest Post Section Starts -->
<?php
    $post = new Post();
    $result = $post->ReadLatestPost();
    
    if($result != '' && $result != '0'){
        $row = $result->fetch_assoc();
?>
<div class="index-post-container">
        <!-- Post Section -->
        <!-- <h2 class="text-center">Read Latest Post</h2> -->
        <div class="post-container">
            <div class="post-inner">

                <div class="post-bottom">
                    <!-- Post Title -->
                    <div class="post-title">
                        <h2><?= $row['post_title']; ?></h2>
                    </div>

                    <!-- Post Publish Details -->
                    <div class="post-publish-detail">
                        Published by
                        <!-- Post Author -->
                        <span class="text-dark underline">
                        <?= $row['post_author']; ?>
                        </span>
                        on
                        <!-- Post Date -->
                        <span class="text-dark underline">
                        <?php
                            echo date('d M Y' , strtotime($row['post_date']));
                        ?>
                        </span>
                    </div>

                    <hr class="bg-light">

                    <!-- Post Content -->
                    <div class="post-content post-content-limited">
                    <?= $row['post_content']; ?>
                    </div>

                    <!-- Read Complete Post -->
                    <div>
                        <a href="postDetail.php?id=<?= $row['post_id']; ?>">Read Complete Post...</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3 text-center">
            <a href="postlist.php" class="btn btn-danger px-5 rounded-0">Read All Posts</a>
        </div>
</div>
<?php } ?>
<!-- Latest Post Section Ends -->

<!-- About Me Section Starts -->
<?php
    $aboutMe = new Users();
    $result = $aboutMe->ReadSingleUser('u_id', 1);
    $row = $result->fetch_assoc();
?>
<div class="index-about-me-container text-center">
    <!-- <h2 class="">Meet The Author</h2> <hr class="mt-0 mb-4"> -->
    <?php if(!empty($row['u_image'])){ ?>
    <div class="about-image">
        <img src="<?= $row['u_image']; ?>"  alt="profile-image">
    </div>
    <?php } ?>
    <div class="about-content">
        <!-- Name -->
        <div class="about-content-name mt-3">
            <span class="text-capitalize font-weight-bold"><?= $row['u_name']; ?></span>
        </div>
        <!-- Designation -->
        <div class="about-content-designation mb-2">
            <span class="text-capitalize font-weight-bold"><?= $row['u_designation']; ?></span>
        </div>
        <!-- Social -->
        <div class="about-content-social mb-3">
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
        <!-- Description -->
        <div class="about-content-detail">
            <?= $row['u_about']; ?>
        </div>
        <div class="form-group mt-3">
            <a href="contact.php" class="btn btn-danger px-5 rounded-0">Connect With Me</a>
        </div>
    </div>
</div>
<!-- About Me Section Ends -->



<!-- Image Gallery Section Starts -->
<?php
    $gallery = new Gallery();
    $result = $gallery->GetTenImage();

    if($result != '' && $result != '0'){
?>
    <div class="index-gallery-container d-flex justify-content-around flex-wrap">

        <div class="gallery-image-container d-flex justify-content-around flex-wrap">
            <?php while($row = $result->fetch_assoc()){ ?>
                <a href="#" data-toggle="modal" data-target="#Gallery-img-modal-<?= $row['id']; ?>">
                    <div class="gallery-image">
                        <img src="<?= $row['image']; ?>" class="img-fluid" alt="<?= $row['caption']; ?>">
                    </div>
                </a>

                <!-- Image Modal -->
                <div class="modal fade" id="Gallery-img-modal-<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="Gallery-img-modal-<?= $row['id']; ?>Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-right py-2">
                            <?= "Date : " . date('d M,Y' , strtotime($row['date'])); ?>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="<?= $row['image']; ?>" class="img-fluid" alt="<?= $row['caption']; ?>">
                        </div>
                        <?php if(!empty($row['caption'])){ ?>
                        <div class="modal-footer text-center bg-white">
                            <div class="gallery-caption w-100">
                            <?= (!empty($row['caption']))? $row['caption']: ''; ?>
                            </div>
                        </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group text-center my-3">
        <a href="gallery.php" class="btn btn-danger px-5 rounded-0">Visit Gallery</a>
    </div>
<?php
    }
?>
<!-- Image Gallery Section End -->

</div>



<?php include __DIR__.'/includes/footer.php'; ?>

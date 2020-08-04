<?php 

session_start();

include_once __DIR__.'/../../model/gallery.class.php';
include_once __DIR__.'/includes/header.php';

include_once __DIR__.'/includes/navbar.php';

include_once __DIR__.'/alert.php';

$image = new Gallery();
$result = $image->GetImage();

?>

<?php if($result == ''){ ?>

    <!-- Not Exists Section -->
    <div class="post-container container">
        <div class="post-inner">
            <div class="post-bottom">
                <h2>No Image Exists</h2>
            </div>
        </div>
    </div>

<?php } else{ ?>
    <!-- Gallery Images -->
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

<?php } ?>

<?php include __DIR__.'/includes/footer.php'; ?>

<?php session_unset(); ?>
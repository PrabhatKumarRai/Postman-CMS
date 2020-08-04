<?php 

include_once __DIR__.'/../includes/header.php';

include_once __DIR__.'/../model/corausal.class.php';

include_once __DIR__.'/alert.php';

$image = new Corausal();
$result = $image->GetImage();

?>
<?php if($result == ''){ ?>

<!-- Not Exists Section -->
<div class="post-container w-100">
    <div class="post-inner">
        <div class="post-bottom">
            <h2>No Corausal Image Exists</h2>
            <div class="mt-3">
                <button class="btn btn-primary rounded-0" data-toggle="modal" data-target="#uploadcorausalmodal">Upload Image</button>
            </div>
        </div>
    </div>
</div>

<?php } else{ ?>
<div class="gallery-head">
    <button class="btn btn-primary rounded-0" data-toggle="modal" data-target="#uploadcorausalmodal">New Image</button>
</div>
<hr>
<!-- Corausal Images -->
<div class="gallery-image-container d-flex justify-content-around flex-wrap">
        <?php while($row = $result->fetch_assoc()){ ?>
            <div class="gallery-image">
                <a href="<?= $row['image']; ?>" target="_blank">
                    <img src="<?= $row['image']; ?>" class="img-fluid" alt="corausal-image">
                </a>
                <div class="d-flex">
                    <!-- Button trigger modal -->
                    <a href='#' class='btn btn-danger w-100 px-0 py-0 m-0 rounded-0' data-toggle="modal" data-target="#deletecorausalModal<?= $row['id']; ?>">Delete</a>

                    <!-- Modal Section Starts -->
                        <!-- Delete Corausal Modal Section Starts -->
                        <div class="modal fade" id="deletecorausalModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Delete Image</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/corausal.inc.php?delete=<?= $row['id']; ?>" method="POST">
                                    <div class="modal-body text-center">
                                        <h5>Are You Sure to Delete this Image ?</h5>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-danger rounded-0" name="delete">Delete</button>
                                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Corausal Modal Section End -->
                    <!-- Modal Section Ends -->

                </div>
            </div>
        <?php } ?>
    </div>

<?php } ?>

<!-- Upload Image Modal Section Starts -->
<div class="modal fade" id="uploadcorausalmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Upload Image</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="../controller/corausal.inc.php?insert" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <label>Select Image :</label><br>
                        <input type="file" class="btn rounded-0 bg-white border" name="photo">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary rounded-0" name="submit">Upload</button>
                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Upload Image Modal Section End -->

<?php include __DIR__.'/../includes/footer.php'; ?>
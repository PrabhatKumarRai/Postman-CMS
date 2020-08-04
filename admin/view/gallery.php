<?php

include_once __DIR__.'/../includes/header.php';

include_once __DIR__.'/../model/gallery.class.php';

include_once __DIR__.'/alert.php';

$image = new Gallery();
$result = $image->GetImage();

?>

<?php if($result == ''){ ?>

    <!-- Not Exists Section -->
    <div class="post-container w-100">
        <div class="post-inner">
            <div class="post-bottom">
                <h2>No Image Exists</h2>
                <div class="mt-3">
                    <button class="btn btn-primary rounded-0" data-toggle="modal" data-target="#uploadimagemodal">Upload Image</button>
                </div>
            </div>
        </div>
    </div>

<?php } else{ ?>
    <div class="gallery-head">
        <button class="btn btn-primary rounded-0" data-toggle="modal" data-target="#uploadimagemodal">New Image</button>
    </div>
    <hr>
    <!-- Gallery Images -->
      <div class="gallery-image-container d-flex justify-content-around flex-wrap">
            <?php while($row = $result->fetch_assoc()){ ?>
                <div class="gallery-image">
                  <a href="#" data-toggle="modal" data-target="#Gallery-img-modal-<?= $row['id']; ?>">
                      <div>
                          <img src="<?= $row['image']; ?>" class="img-fluid" alt="<?= $row['caption']; ?>">
                      </div>
                  </a>

                  <div class="d-flex mt-1">
                      <!-- Button trigger modal -->
                      <a href='#' class='btn btn-primary w-50 px-0 py-0 m-0 rounded-0' data-toggle="modal" data-target="#editImageModal<?= $row['id']; ?>">Edit</a>
                      <a href='#' class='btn btn-danger w-50 px-0 py-0 m-0 rounded-0' data-toggle="modal" data-target="#deleteImageModal<?= $row['id']; ?>">Delete</a>

                      <!-- Modal Section Starts -->

                          <!-- Display Image Modal Section Starts -->
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
                          <!-- Display Image Modal Section Ends -->
                          <!-- Edit Image Modal Section Starts -->
                          <div class="modal fade" id="editImageModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                  <div class="modal-header">
                                      <h6 class="modal-title" id="exampleModalLabel">Edit Image</h6>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <form action="../controller/gallery.inc.php?edit=<?= $row['id'] ?>" method="POST">
                                      <div class="modal-body">
                                              <div class="form-group">
                                                  <div class="text-center">
                                                      <img src="<?= $row['image']; ?>" class="img-fluid" alt="gallery-image">
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Caption :</label>
                                                      <textarea name="caption" class="form-control"><?= $row['caption']; ?></textarea>
                                                  </div>
                                              </div>
                                      </div>
                                      <div class="modal-footer justify-content-center">
                                          <button type="submit" class="btn btn-primary rounded-0" name="edit">Update</button>
                                          <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
                                      </div>
                                  </form>
                                  </div>
                              </div>
                          </div>
                          <!-- Edit Image Modal Section End -->

                          <!-- Delete Image Modal Section Starts -->
                          <div class="modal fade" id="deleteImageModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                  <div class="modal-header">
                                      <h6 class="modal-title" id="exampleModalLabel">Delete Image</h6>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <form action="../controller/gallery.inc.php?delete=<?= $row['id']; ?>" method="POST">
                                      <div class="modal-body text-center">
                                          <h5>Are You Sure to Delete this Image ?</h5>
                                          <p class="text-danger mb-0">Note: Media attached will also be deleted.</p>
                                      </div>
                                      <div class="modal-footer justify-content-center">
                                          <button type="submit" class="btn btn-danger rounded-0" name="delete">Delete</button>
                                          <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
                                      </div>
                                  </form>
                                  </div>
                              </div>
                          </div>
                          <!-- Delete Image Modal Section End -->
                      <!-- Modal Section Ends -->

                  </div>
                </div>
            <?php } ?>
        </div>

<?php } ?>

<!-- Upload Image Modal Section Starts -->
<div class="modal fade" id="uploadimagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Upload Image</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="../controller/gallery.inc.php?insert" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Select Image :</label><br>
                            <input type="file" class="btn rounded-0 bg-white border" name="photo">
                        </div>
                        <div class="form-group">
                            <label>Caption :</label>
                            <textarea name="caption" class="form-control"></textarea>
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
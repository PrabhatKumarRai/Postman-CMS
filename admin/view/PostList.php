<?php 

    include_once __DIR__.'/../includes/header.php';

    include_once __DIR__.'/../model/post.class.php'; 


    include_once __DIR__.'/alert.php';
?>
<div class="d-flex justify-content-between mobile-justify-content-around flex-wrap">
    <?php  
        $selectpost = new Post();
        $result= $selectpost->ReadAllPostReverse();
        if($result == ''){
            ?>
                    <!-- Not Exists Section -->
                    <div class="post-container w-100">
                        <div class="post-inner">
                            <div class="post-bottom">
                                <!-- Post Title -->
                                <h2>No Post Exists</h2>
                                <div class="mt-3">
                                    <a href="addpost.php" class="btn btn-primary rounded-0">Create Post</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php 
        }
        elseif($result == '0'){
            ?>
                    <!-- SQL ERROR Section -->
                    <div class="post-container">
                        <div class="post-inner">
                            <div class="post-bottom">
                                <!-- SQL ERROR Section -->
                                <h2>SQL Error Occured !!!</h2>
                            </div>
                        </div>
                    </div>
            <?php 
        }
        else{

            while($row = $result->fetch_assoc()){
    ?>

                <div class="post-card-container">
                    
                    <?php if($row['draft'] == 1){ ?>
                    <!-- Draft Section Starts -->
                    <div class="notification-absolute-badge">
                        <span class="badge badge-success font-weight-light">Draft</span>
                    </div>
                    <!-- Draft Section Ends -->
                    <?php } ?>

                    <!-- Post Title -->
                    <div class="post-card-title limit-1">
                        <h2><?= $row['post_title']; ?></h2>
                    </div>
                    <!-- Post Author -->
                    <div class="post-card-author limit-1">
                        Author : <?= $row['post_author']; ?>
                    </div>
                    <!-- Post Date -->
                    <div class="post-card-date">
                        Date : <?= date('d M,Y' , strtotime($row['post_date'])); ?>
                    </div>
                    <hr class="bg-lightgrey my-2">
                    <!-- Post Content -->
                    <div class="post-card-content limit-3">
                        <?= $row['post_content']; ?>
                    </div>
                    <div class="post-card-detail">
                        <a href="postDetail.php?id=<?= $row['post_id']; ?>">Read Complete Post</a>
                    </div>
                    <hr class="bg-lightgrey my-2">
                    <!-- Post Action -->
                    <div class="post-card-action d-flex">
                        <a href='updatePost.php?id=<?= $row['post_id']; ?>' class='btn btn-primary w-50 px-0 m-0 rounded-0'>Edit</a>
                        <!-- Button trigger modal -->
                        <a href='#' class='btn btn-danger w-50 px-0 m-0 rounded-0' data-toggle="modal" data-target="#deletePostModal<?= $row['post_id']; ?>">Delete</a>
                        
                        <!-- Delete Confirmation Modal Section Starts -->
                        <div class="modal fade" id="deletePostModal<?= $row['post_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Delete Confirmation</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <h5>Are You Sure to Delete this Post ?</h5>
                                    <p class="text-danger mb-0">Note: Media attached will also be deleted.</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <a href='../controller/posts.inc.php?delete=<?= $row['post_id']; ?>' class="btn btn-danger rounded-0">Delete</a>
                                    <button type="button" class="btn btn-primary rounded-0" data-dismiss="modal">Cancel</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Confirmation Modal Section End -->
                    </div>
                </div>
        
    <?php 
            }
        }
    ?>

</div>

<?php include_once __DIR__.'/../includes/footer.php'; ?>
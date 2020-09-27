<?php

include_once __DIR__.'/../includes/header.php';

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}



include_once __DIR__.'/../model/post.class.php';
include_once __DIR__.'/../model/comment.class.php';

include_once __DIR__.'/alert.php';
?>


<?php

    $id = $_GET['id'];
    $postobj = new Post();
    $post = $postobj->ReadSinglePost('post_id', $id);


    if($post == ''){
?>
        <!-- No Post Exists Section -->
        <div class="post-container w-100">
            <div class="post-inner">
                <div class="post-bottom">
                    <!-- Post Title -->
                    <div class="post-title text-center">
                        <h2>No Posts Found !!!</h2>
                        <a href="addpost.php" class="btn btn-primary rounded-0">Create Post</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    elseif($post == '0'){
?>
        <!-- SQL Error Section -->
        <div class="post-container">
            <div class="post-inner">
                <div class="post-bottom">
                    <!-- Post Title -->
                    <div class="post-title">
                        <h2>SQL Error Occured !!!</h2>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    else{
        $row = $post->fetch_assoc();
?>
            <!-- Post Section -->
            <div class="post-container">
                <div class="post-inner">

                    <div class="post-top">
                        <!-- Post Featured Image -->
                        <div class="post-featured-image">
                            <?php
                                if(!empty($row['post_featured_image'])){
                            ?>
                                <img src="<?= $row['post_featured_image']; ?>" alt="featured image">
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                    <div class="post-bottom">
                        <!-- Post Title -->
                        <div class="post-title">
                            <h2><?= $row['post_title']; ?></h2>
                        </div>

                        <!-- Post Publish Details -->
                        <div class="post-publish-detail">
                            Published by
                            <!-- Post Author -->
                            <a href="about.php" class="text-dark underline"><?= $row['post_author']; ?></a>
                            on
                            <!-- Post Date -->
                            <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['post_date'])); ?></span>
                        </div>
                        

                        <!-- Post Updated Section -->
                        <?php if(strcmp($row['post_date'], $row['post_updated']) != 0){ ?>    <!-- if the post creation date and the post updated dates are not the same then display the Last Updated Section -->
                            <div class="post-updated post-publish-detail">
                                Last Updated : <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['post_updated'])); ?></span>
                            </div>
                        <?php } ?>

                        
                        <!-- Draft Symbol Section Starts -->
                        <?php 
                            if($row['draft'] == 1){
                        ?>
                        <div class="text-success font-weight-500">
                                (Draft Post)
                        </div>
                        <?php
                            }
                        ?>
                        <!-- Draft Symbol Section Ends -->

                        <hr class="bg-light">

                        <!-- Post Content -->
                        <div class="post-content">
                            <?= $row['post_content']; ?>
                        </div>

                        <!-- Post Action -->
                        <div class="d-flex justify-content-center">
                            <a href='updatePost.php?id=<?= $row['post_id']; ?>' class='btn btn-primary w-25 px-0 mr-1 rounded-0'>Edit</a>
                            <a href='#' class='btn btn-danger w-25 px-0 ml-1 rounded-0' data-toggle="modal" data-target="#deletePostModal">Delete</a>


                        <!-- Delete Confirmation Modal Section Starts -->
                        <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                </div>
            </div>
            
            <!-- Comments Section -->
            <?php if($row['comment_status'] == 1){ ?>
                <div class="comment-container post-container px-3 pt-4 pb-2">
                    <div class="mb-4">
                        <!-- Button Trigger Comment modal -->
                        <a href="#" class="btn btn-primary rounded-0 px-4" data-toggle="modal" data-target="#NewCommentModal">New Comment</a>

                        <!-- New Comment Modal Section Starts -->
                        <div class="modal fade" id="NewCommentModal" tabindex="-1" role="dialog" aria-labelledby="NewCommentModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="../controller/comment.inc.php" method="POST">
                                        <div class="modal-header py-2">
                                            <h5 class="modal-title" id="exampleModalLongTitle">New Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-3">
                                            <input type="hidden" name="post_id" value="<?= $row['post_id']; ?>">
                                            <div class="form-group mb-0">
                                                <textarea name="newcomment" cols="30" rows="2" class="form-control" placeholder="Comment" required><?= (isset($_GET['comment']))? $_GET['comment']: '' ; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer w-100 justify-content-center py-2">
                                            <button type="submit" class="btn btn-primary px-5 rounded-0" name="insertcomment">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- New Comment Modal Section Ends -->
                    </div>
                    <!-- Comment List Starts -->
                    <div class="comment-list text-left">
                        <?php
                            $comment = new Comment();
                            $result = $comment->GetAllCommentReverse();

                            if($result != '' && $result != '0'){
                                while($row = $result->fetch_assoc()){
                                    if($row['post_id'] == $_GET['id']){

                                        $reply = $comment->GetReply($row['c_id']);
                        ?>          
                                    <!--------- Comment Details Starts --------->
                                    <div class="comment-list-item p-2 jumbotron rounded-0 word-break position-relative">                                       
                                        <!-- Comment By -->
                                        <div class="comment-list-item-name">
                                            <h5 class="mb-0">
                                                <?= $row['c_name']; ?>
                                                <!-- If Comment by admin then disply symbol Section Starts -->
                                                <?php if($row['c_admin'] == 1){ ?>
                                                    <span class="text-success font-12">(Admin)</span>
                                                <?php } ?>
                                                <!-- If Comment by admin then disply symbol Section Ends -->
                                            </h5>
                                        </div>
                                        <!-- Comment Date -->
                                        <div class="comment-list-item-date mb-2">
                                            <?= date('d M,Y h:i:s a', strtotime($row['c_date'])); ?>
                                        </div>
                                        <!-- Comment Detail -->
                                        <div class="comment-list-item-comment">
                                            <?= $row['c_comment']; ?>
                                        </div>

                                        <!-- All Buttons and Edit Comment and Comment Reply Modal -->
                                        <div class="my-0">
                                            <div class="text-right font-weight-500 font-14">
                                                <!-- Display view reply button only if any reply exists -->
                                                <?php if($reply != ''){ ?>
                                                    
                                                    <a data-toggle="collapse" href="#comment-reply-<?= $row['c_id']; ?>" role="button" aria-expanded="false" aria-controls="comment-reply<?= $row['c_id']; ?>"><i class="fa fa-eye"></i> View Replies (<?php print_r($reply->num_rows); ?>)</a>
                                                <?php } ?>
                                                <!-- Reply Button -->
                                                <a href="#" class="text-decoration-none ml-2" data-toggle="modal" data-target="#CommentReplyModal<?= $row['c_id']; ?>"><i class="fa fa-reply"></i> Reply</a>
                                                <!-- Edit Button -->
                                                <?php if($row['c_admin'] == 1){ ?>
                                                    <a href="#" class="text-decoration-none ml-2" data-toggle="modal" data-target="#EditCommentModal<?= $row['c_id']; ?>"><i class="fa fa-edit"></i></a>
                                                <?php } ?>
                                                <!-- Delete Button -->
                                                <form action="../controller/comment.inc.php" method="POST" class="d-inline ml-2">
                                                    <input type="hidden" name="c_id" value="<?= $row['c_id']; ?>">
                                                    <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                                                    <button class="delete-icon-btn" name="deletecomment"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                            
                                            <?php if($row['c_admin'] == 1){ ?>
                                            <!-- Edit Comment Modal Section Starts -->
                                            <div class="modal fade" id="EditCommentModal<?= $row['c_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditCommentModal<?= $row['c_id']; ?>Title" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="../controller/comment.inc.php" method="POST">
                                                            <div class="modal-header py-2">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Comment</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-3">
                                                                <input type="hidden" name="c_id" value="<?= $row['c_id']; ?>">
                                                                <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                                                                <div class="form-group mb-0">
                                                                    <textarea name="newcomment" cols="30" rows="2" class="form-control" required><?= $row['c_comment']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer w-100 justify-content-center py-2">
                                                                <button type="submit" class="btn btn-primary px-4 rounded-0" name="editcomment">Edit Comment</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Comment Modal Section Ends -->
                                            <?php } ?>
                                            <!-- Comment Reply Modal Section Starts -->
                                            <div class="modal fade" id="CommentReplyModal<?= $row['c_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="CommentReplyModal<?= $row['c_id']; ?>Title" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="../controller/comment.inc.php" method="POST">
                                                            <div class="modal-header py-2">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">New Reply</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-3">
                                                                <input type="hidden" name="c_id" value="<?= $row['c_id']; ?>">
                                                                <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                                                                <div class="form-group mb-0">
                                                                    <textarea name="newreply" cols="30" rows="2" class="form-control" placeholder="Comment Reply" required><?= (isset($_GET['reply']))? $_GET['reply']: '' ; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer w-100 justify-content-center py-2">
                                                                <button type="submit" class="btn btn-primary px-5 rounded-0" name="insertreply">Reply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment Reply Modal Section Ends -->
                                        </div>

                                        <div class="collapse" id="comment-reply-<?= $row['c_id'] ?>">
                                        <?php
                                            if($reply != '' && $reply != '0'){
                                                while($row1 = $reply->fetch_assoc()){
                                        ?>
                                            <hr>
                                            <!--------- Reply Details Starts --------->
                                            <div class="ml-3">
                                                <!-- Reply By -->
                                                <div class="comment-list-item-reply-name">
                                                    <h6 class="mb-0">
                                                        <?= $row1['cr_name']; ?>
                                                        <!-- If Reply by admin then disply symbol Section Starts -->
                                                        <?php if($row1['cr_admin'] == 1){ ?>
                                                            <span class="text-success font-12">(Admin)</span>
                                                        <?php } ?>
                                                        <!-- If Reply by admin then disply symbol Section Ends -->
                                                    </h6>
                                                </div>
                                                <!-- Reply Date -->
                                                <div class="comment-list-item-reply-date mb-2">
                                                    <?= date('d M,Y h:i:s a', strtotime($row1['cr_date'])); ?>
                                                </div>
                                                <!-- Reply Detail -->
                                                <div class="comment-list-item-comment">
                                                    <?= $row1['cr_reply']; ?>
                                                </div>
                                                <!-- Delete & Edit Reply Section Starts -->
                                                <div class="text-right font-14">
                                                    <!-- Edit Button -->
                                                    <?php if($row1['cr_admin'] == 1){ ?>
                                                        <a href="#" class="text-decoration-none mr-2" data-toggle="modal" data-target="#EditReplyModal<?= $row1['cr_id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <?php } ?>
                                                    <!-- Delete Button -->
                                                    <form action="../controller/comment.inc.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="cr_id" value="<?= $row1['cr_id']; ?>">
                                                        <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                                                        <button class="delete-icon-btn" name="deletereply"><i class="fa fa-trash"></i></button>
                                                    </form>                                                    
                                                
                                                    <!-- Edit Reply Modal Section Starts -->
                                                    <div class="modal fade" id="EditReplyModal<?= $row1['cr_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="CommentReplyModal<?= $row['c_id']; ?>Title" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <form action="../controller/comment.inc.php" method="POST">
                                                                    <div class="modal-header py-2">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Reply</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body py-3">
                                                                        <input type="hidden" name="cr_id" value="<?= $row1['cr_id']; ?>">
                                                                        <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                                                                        <div class="form-group mb-0">
                                                                            <textarea name="newreply" cols="30" rows="2" class="form-control" required><?= $row1['cr_reply']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer w-100 justify-content-center py-2">
                                                                        <button type="submit" class="btn btn-primary px-4 rounded-0" name="editreply">Edit Reply</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Edit Reply Modal Section Ends -->
                                                </div>
                                                <!-- Delete & Edit Reply Section Ends -->
                                            </div>
                                            <!--------- Reply Details Ends --------->
                                                <?php
                                                        }
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                    <!--------- Comment Details Ends --------->
                        <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                    <!-- Comment List Ends -->
                </div>
            <?php }else{ ?>
              <!-- Comments Disabled Section Starts -->
                <div class="post-container">
                    <div class="post-inner">
                        <div class="post-bottom">
                            <!-- Post Title -->
                            <div class="post-title text-center">
                                <h5>Comments are disabled for this Post.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- Comments Disabled Section Ends -->

<?php
    }
?>


<?php include __DIR__.'/../includes/footer.php'; ?>
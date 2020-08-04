<?php

session_start();

if(!isset($_GET['id'])){
    header("Location: index.php");
}


include_once __DIR__.'/includes/header.php';

include_once __DIR__.'/../../model/post.class.php';
include_once __DIR__.'/../../model/comment.class.php';

include_once __DIR__.'/alert.php';
?>


<?php

    $id = $_GET['id'];
    $postobj = new Post();
    $post = $postobj->ReadSinglePost('post_id', $id);


    if($post == ''){
?>
        <!-- No Post Exists Section -->
        <div class="post-container">
            <div class="post-inner">
                <div class="post-bottom">
                    <!-- Post Title -->
                    <div class="post-title text-center">
                        <h2>No Posts Found !!!</h2>
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

                        <hr class="bg-light">

                        <!-- Post Content -->
                        <div class="post-content">
                            <?= $row['post_content']; ?>
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

                        <!-- Comment Modal Section Starts -->
                        <div class="modal fade" id="NewCommentModal" tabindex="-1" role="dialog" aria-labelledby="NewCommentModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="../../controller/comment.inc.php" method="POST">
                                        <div class="modal-header py-2">
                                            <h5 class="modal-title" id="exampleModalLongTitle">New Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-3">
                                            <input type="hidden" name="post_id" value="<?= $row['post_id']; ?>">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Name" <?= (isset($_GET['name']))? $_GET['name']: '' ; ?> required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="Email" <?= (isset($_GET['email']))? $_GET['email']: '' ; ?> required>
                                            </div>
                                            <div class="form-group mb-0">
                                                <textarea name="newcomment" cols="30" rows="2" class="form-control" placeholder="Comment" required><?= (isset($_GET['comment']))? $_GET['comment']: '' ; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer w-100 justify-content-center py-2">
                                            <button type="submit" class="btn btn-primary px-5 rounded-0" name="comment">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Modal Section Ends -->
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
                                    <div class="comment-list-item p-2 jumbotron rounded-0 word-break">
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
                                        <div class="comment-list-item-date mb-2">
                                            <?= date('d M,Y h:i:s a', strtotime($row['c_date'])); ?>
                                        </div>
                                        <div class="comment-list-item-comment">
                                            <?= $row['c_comment']; ?>
                                        </div>

                                        <!-- Button Trigger Reply modal -->
                                        <div class="my-0">
                                            <div class="text-right font-weight-500 font-14">
                                                <!-- Display view reply button only if any reply exists -->
                                                <?php if($reply != ''){ ?>
                                                    <a data-toggle="collapse" href="#comment-reply-<?= $row['c_id']; ?>" role="button" aria-expanded="false" aria-controls="comment-reply<?= $row['c_id']; ?>"><i class="fa fa-eye"></i> View Replies (<?php print_r($reply->num_rows); ?>)</a>
                                                <?php } ?>
                                                <a href="#" class="text-decoration-none ml-2" data-toggle="modal" data-target="#CommentReplyModal<?= $row['c_id']; ?>"><i class="fa fa-reply"></i> Reply</a>
                                            </div>

                                            <!-- Comment Reply Modal Section Starts -->
                                            <div class="modal fade" id="CommentReplyModal<?= $row['c_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="CommentReplyModal<?= $row['c_id']; ?>Title" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="../../controller/comment.inc.php" method="POST">
                                                            <div class="modal-header py-2">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">New Reply</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-3">
                                                                <input type="hidden" name="c_id" value="<?= $row['c_id']; ?>">
                                                                <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="name" placeholder="Name" <?= (isset($_GET['name']))? $_GET['name']: '' ; ?> required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" name="email" placeholder="Email" <?= (isset($_GET['email']))? $_GET['email']: '' ; ?> required>
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <textarea name="newreply" cols="30" rows="2" class="form-control" placeholder="Comment" required><?= (isset($_GET['reply']))? $_GET['reply']: '' ; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer w-100 justify-content-center py-2">
                                                                <button type="submit" class="btn btn-primary px-5 rounded-0" name="reply">Reply</button>
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
                                            <div class="ml-3">
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
                                                <div class="comment-list-item-reply-date mb-2">
                                                    <?= date('d M,Y h:i:s a', strtotime($row1['cr_date'])); ?>
                                                </div>
                                                <div class="comment-list-item-comment">
                                                    <?= $row1['cr_reply']; ?>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                        </div>
                                    </div>
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


<?php include __DIR__.'/includes/footer.php'; ?>

<?php session_unset(); ?>

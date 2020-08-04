<?php

    include_once __DIR__.'/../includes/header.php';

    if(!isset($_GET['data'])){
        header("Location: index.php");
    }


    include_once __DIR__.'/../model/enquiry.class.php';
    include_once __DIR__.'/../model/comment.class.php';
    include_once __DIR__.'/../model/post.class.php';
    include_once __DIR__.'/alert.php';

    $enquiry = new Enquiry();
    $comment = new Comment();
    $post = new Post();
?>

<div class="dashboard-detail-container">
    <?php if($_GET['data'] == "enquiry"){ ?>
        <!-- Enquiry Section -->
        <?php
            $enquiry = new Enquiry();
            $result = $enquiry->GetAllUnreadEnquiry();
        
        ?>
        <?php if($result == '' || $result == '0'){ ?>
        
            <!-- Not Exists Section -->
            <div class="post-container w-100">
                <div class="post-inner">
                    <div class="post-bottom">
                        <h2>No Enquiry Exists</h2>
                    </div>
                </div>
            </div>
        
        <?php } else{ ?>
            <!-- Enquiry List -->
            <div class="Enquiry-container">
                <div class="font-weight-500 mb-3 font-italic">
                    Total Enquiry : <?= $result->num_rows ?>
                </div>     
                <div class="accordion" id="Enquiry_list">
                    <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="card mb-3">                
                            <div class="card-header d-flex" id="enquiry_heading_<?= $row['id']; ?>">
                                <div class="w-75 font-weight-bold limit-1">
                                    <a href="#" class="collapsed text-decoration-none text-dark" data-toggle="collapse" data-target="#enquiry_<?= $row['id']; ?>" aria-expanded="false" aria-controls="enquiry_<?= $row['id']; ?>">
                                        <?= $row['subject']; ?>
                                    </a>
                                </div>
                                <div class="w-25 pl-2 limit-1">by, <?= $row['name']; ?></div>
                                <!-- Delete Icon -->
                                <div class="delete-icon">
                                    <a href="#" class="text-dark" data-toggle="modal" data-target="#deleteEnquiryModal">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <!-- Replied Symbol -->
                                <?php if(!empty($row['reply'])){ ?>
                                    <div class="replied-symbol-outer">
                                        <div class="replied-symbol-inner">                                    
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div id="enquiry_<?= $row['id']; ?>" class="collapse" aria-labelledby="enquiry_heading_<?= $row['id']; ?>" data-parent="#Enquiry_list">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-wrap mb-3 font-weight-500 font-14">
                                        <!-- Email ID -->
                                        <div>
                                            Email ID : <?= $row['email'] ?>
                                        </div>
                                        <!-- Date -->
                                        <div>
                                            Date: <?= date('d M,Y h:i:s a', strtotime($row['date'])); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="font-weight-500">Enquiry : </span>
                                        <?= $row['enquiry']; ?>
                                    </div>
                                    <!----------- Reply Starts ----------->
                                    <!-- Display Sent Reply -->
                                    <?php if(!empty($row['reply'])){ ?>
                                    <div class="enquiry-sent-reply mt-3 mb-2">
                                        <span class="text-success"><span class="font-weight-bold">Replied</span> on <?= date('d M,Y h:i:s a' , strtotime($row['reply_date'])); ?> : </span>
                                        <span><?= $row['reply']; ?></span>                            
                                    </div>
                                    <form action="../controller/enquiry.inc.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button class="btn btn-danger btn-sm rounded-0" name="delete-reply">Delete Reply</button>
                                    </form>
                                    <?php }else{ ?>
                                    
                                    <!-- Send Reply -->
                                    <div class="mt-3">
                                        <form action="../controller/enquiry.inc.php" method="POST">
                                            <input type="hidden" name="enquiry-id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="enquiry-email" value="<?= $row['email'] ?>">
                                            <input type="hidden" name="enquiry-subject" value="<?= $row['subject'] ?>">
                                            <div class="form-group">
                                                <textarea name="enquiry-reply"cols="30" rows="5" class="form-control rounded-0" placeholder="Send Reply.."></textarea>
                                            </div>
                                            <button class="btn btn-primary rounded-0 py-1 px-4" name="send">Send</button>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <!----------- Reply Ends ----------->
                                </div>
                            </div>                
                            <!-- Delete Confirmation Modal Section Starts -->
                            <div class="modal fade" id="deleteEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Delete Confirmation</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h5>Are You Sure to Delete this Enquiry ?</h5>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <form action="../controller/enquiry.inc.php" method="POST">
                                            <input type="hidden" name="delete-id" value="<?= $row['id']; ?>">
                                            <button class="btn btn-danger rounded-0" name="delete">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-primary rounded-0" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Confirmation Modal Section End -->
                        </div>                
                    <?php } ?>
                </div>
            
            </div>
        
    <?php } ?>


    <?php }elseif($_GET['data'] == "comment"){ ?>
            <!-- Comment Section -->
            <?php
                $result = $comment->GetSevenDaysComment();
                if($result != '' && $result != '0'){

                    $distinctPostId[] = '';     //Defining Blank Array

                    while($sevenDaysComment = $result->fetch_assoc()){
                        if(!in_array($sevenDaysComment['post_id'], $distinctPostId)){
                            $distinctPostId[] = $sevenDaysComment['post_id'];
                        }
                    }

                    //Converting Array to String
                    $distinctPostId = implode(",", $distinctPostId);
                    $distinctPostId = ltrim($distinctPostId, ',');       //Removes first character ','
                    
                    //Getting filtered post
                    $selectpost = new Post();
                    $result= $selectpost->ReadFilteredPost($distinctPostId);
                }
            ?>

            <div class="d-flex justify-content-between mobile-justify-content-around flex-wrap">
                <?php  
                    if($result == ''){
                        ?>
                                <!-- Not Exists Section -->
                                <div class="post-container w-100">
                                    <div class="post-inner">
                                        <div class="post-bottom">
                                            <!-- Post Title -->
                                            <h2>No Comments Exists</h2>
                                        </div>
                                    </div>
                                </div>
                        <?php 
                    }
                    elseif($result == '0'){
                        ?>
                                <!-- SQL ERROR Section -->
                                <div class="post-container w-100">
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
                ?>
                        
                        <div class="font-weight-500 mb-3 font-italic w-100">
                            Total Posts : <?= $result->num_rows ?>
                        </div>
                <?php

                        while($row = $result->fetch_assoc()){
                ?>                       

                            <div class="post-card-container">
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
                                    <a href='#' class='btn btn-danger w-50 px-0 m-0 rounded-0' data-toggle="modal" data-target="#deletePostModal">Delete</a>
                                    
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
                    
                <?php 
                        }
                    }
                ?>

            </div>
    <?php } ?>

</div>


<?php include_once __DIR__.'/../includes/footer.php'; ?>
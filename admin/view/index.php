<?php

    include_once __DIR__.'/../includes/header.php';

    include_once __DIR__.'/../model/enquiry.class.php';
    include_once __DIR__.'/../model/comment.class.php';
    include_once __DIR__.'/../model/post.class.php';
    include_once __DIR__.'/../model/gallery.class.php';
    include_once __DIR__.'/../model/corausal.class.php';
    include_once __DIR__.'/../model/users.class.php';
    include_once __DIR__.'/../model/admintheme.class.php';
    include_once __DIR__.'/../model/website_setting.class.php';

    include_once 'alert.php';

    $enquiry = new Enquiry();
    $comment = new Comment();
    $post = new Post();
    $gallery = new Gallery();
    $corausal = new Corausal();
    $user = new Users();
    $admintheme = new Admintheme();
    $website_setting = new Website_setting();
?>

<div class="index-container text-center d-flex justify-content-between flex-wrap">
    
    <!-- Enquiry Section -->
    <div class="index-card">
        <a href="dashboard-detail.php?data=enquiry">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Enquiry</div>
                    <div class="index-card-tagline">Unreplied</div>
                    <?php
                        $result = $enquiry->GetAllUnreadEnquiry();
                        if($result != '' && $result != '0'){
                            $unreadEnquiry = $result->num_rows;
                        }
                        else{
                            $unreadEnquiry = 0;
                        }
                    ?>
                    <div class="index-card-body w-100"><?= $unreadEnquiry; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Comment Section -->
    <div class="index-card">
        <a href="dashboard-detail.php?data=comment">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Comments</div>
                    <div class="index-card-tagline">Last 7 Days</div>
                    <?php
                        $result = $comment->GetSevenDaysComment();
                        if($result != '' && $result != '0'){
                            $sevenDaysComment = $result->num_rows;
                        }
                        else{
                            $sevenDaysComment = 0;
                        }
                    ?>
                    <div class="index-card-body w-100"><?= $sevenDaysComment; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Latest Post Section -->
    <div class="index-card">
        <?php
            $result = $post->ReadLatestPost();

            if($result != '' && $result != '0'){
                $latestPost = $result->fetch_assoc();
    
                $result = $comment->GetLatestPostComments($latestPost['post_id']);
                
                if($result != '' && $result != '0'){
                    $latestPostComments = $result->num_rows;
                }
                else{
                    $latestPostComments = 0;
                }
            }
            else{
                $latestPostComments = "---";
            }
        ?>
        <a href="postdetail.php?id=<?= $latestPost['post_id']; ?>">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Latest Post</div>
                    <div class="index-card-tagline">Comments</div>
                    <div class="index-card-body w-100"><?= $latestPostComments; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total Post Section -->
    <div class="index-card">
        <?php
            $result = $post->ReadAllPost();

            if($result != '' && $result != '0'){
                $totalPost = $result->fetch_assoc();

                $totalPost = $result->num_rows;
            }
            else{
                $totalPost = 0;
            }
        ?>
        <a href="postlist.php">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Posts</div>
                    <div class="index-card-tagline">Total</div>
                    <div class="index-card-body w-100"><?= $totalPost; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Draft Post Section -->
    <div class="index-card">
        <?php
            $result = $post->ReadDraftPost();

            if($result != '' && $result != '0'){
                $row = $result->fetch_assoc();
                $draftPost = $result->num_rows;
            }
            else{
                $draftPost = 0;
            }
        ?>
        <a href="postdraft.php">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Draft Post</div>
                    <div class="index-card-tagline">Total</div>
                    <div class="index-card-body w-100"><?= $draftPost; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Gallery Section -->
    <div class="index-card">
        <a href="gallery.php">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Gallery Images</div>
                    <div class="index-card-tagline">Total</div>
                    <?php
                        $result = $gallery->GetImage();

                        if($result != '' && $result != '0'){
                            $ImageCount = $result->num_rows;
                        }
                        else{
                            $ImageCount = 0;
                        }
                    ?>
                    <div class="index-card-body w-100"><?= $ImageCount; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Corausal Section -->
    <div class="index-card">
        <a href="corausal.php">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Corausal Images</div>
                    <div class="index-card-tagline">Total</div>
                    <?php
                        $result = $corausal->GetImage();

                        if($result != '' && $result != '0'){
                            $ImageCount = $result->num_rows;
                        }
                        else{
                            $ImageCount = 0;
                        }
                    ?>
                    <div class="index-card-body w-100"><?= $ImageCount; ?></div>
                </div>
            </div>
        </a>
    </div>

    <!-- Users Section -->
    <div class="index-card">
        <a href="settings.php">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">User Settings</div>
                    <div class="index-card-tagline">Last Updated</div>
                    <?php
                        $result = $user->ReadSingleUser('u_id', 1);
                        if($result != '' && $result != '0'){
                            $row = $result->fetch_assoc();                        
                    ?>
                    <div class="index-card-body w-100"><?=date('d M, Y' , strtotime($row['last_updated'])); ?></div>
                    <?php }else{ ?>
                        <div class="index-card-body w-100">---</div>
                    <?php } ?>
                </div>
            </div>
        </a>
    </div>

    <!-- Website Section -->
    <div class="index-card">
        <a href="settings.php">
            <div class="index-card-inner">
                <div>
                    <div class="index-card-head w-100">Website Theme</div>
                    <div class="index-card-tagline">Current</div>
                    <?php
                        $result = $website_setting->GetWebsiteSetting();
                        if($result != '' && $result != '0'){
                            $row = $result->fetch_assoc();                        
                    ?>
                    <div class="index-card-body w-100 text-capitalize"><?= $row['theme'] . " (" . $row['theme_color_name'] . ")"; ?></div>
                    <?php }else{ ?>
                    <div class="index-card-body w-100 text-capitalize">---</div>
                    <?php } ?>
                </div>
            </div>
        </a>
    </div>

</div>

<?php include_once __DIR__.'/../includes/footer.php'; ?>
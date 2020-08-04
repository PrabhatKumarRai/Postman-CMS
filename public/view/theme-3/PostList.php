<?php 

    session_start();

    include_once __DIR__.'/../../model/post.class.php'; 

    include_once __DIR__.'/includes/header.php';

    include_once __DIR__.'/alert.php';

?>
<div class="d-flex justify-content-between mobile-justify-content-around flex-wrap container mt-3">
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
                </div>
        
    <?php 
            }
        }
    ?>

</div>

<?php 
    include __DIR__.'/includes/footer.php';
?>

<?php session_unset(); ?>
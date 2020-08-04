<?php

include_once __DIR__.'/../includes/header.php';

if(!isset($_POST['submit'])){
    header("Location: index.php");
}


include_once __DIR__.'/../model/post.class.php';
include_once __DIR__.'/alert.php';

?>

  
    <?php
        $searchText = htmlentities($_POST['search']);
        
        $search = new Post();
        $result = $search->SearchPost($searchText);
        
        if($result == ''){
    ?>
            <!-- No Records Found -->
            <div class="search-links-container w-100">
                <div class="search-links-inner text-center py-3">
                    <h4>No record matches your Search!!!</h4>
                </div>
            </div>
    <?php
        }
        elseif($result == '0'){
    ?>
            <div class="search-links-container">
                <div class="search-links-inner text-center py-3">
                    <h4>SQL Error Occured!!!</h4>
                </div>
            </div>
    <?php
        }
        else{

            while($row = $result->fetch_assoc()){
            
    ?>
            <div class="search-links-container">
                <div class="search-links-inner">
                    <!-- Post Title -->
                    <div class="search-links-title limit-1">
                        <a href="<?= ROOT_URL_ADMIN ?>view/postDetail.php?id=<?= $row['post_id']; ?>"><?= $row['post_title']; ?></a>
                    </div>
                    <!-- Post Publish Details -->
                    <div class='search-links-publish text-secondary limit-2'>
                        Published by 
                        <span class="text-dark underline"><?= $row['post_author']; ?></span> 
                        on 
                        <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['post_date'])); ?></span>
                        <?php
                            if(strcmp($row['post_date'], $row['post_updated']) != 0){
                        ?>
                        Last Updated : <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['post_updated'])); ?></span>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- Post Contents -->
                    <div class="search-links-content limit-2">
                        <?= $row['post_content']; ?>
                    </div>
                </div>
            </div>
    <?php
            }
        }
    ?>
                    

<?php include_once __DIR__.'/../includes/footer.php';?>
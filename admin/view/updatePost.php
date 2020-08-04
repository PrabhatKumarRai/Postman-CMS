<?php

include_once __DIR__.'/../includes/header.php';

if(!isset($_GET['id'])){
    header("Location: PostList.php");
}

?>


<?php 

    include_once __DIR__.'/../model/post.class.php';

    include_once __DIR__.'/alert.php';
?>


<?php
      
    $id = $_GET['id'];

    $selectpost = new Post();
    $result= $selectpost->ReadSinglePost('post_id', $id);
    $row = $result->fetch_assoc();

?>

<div>
    <form action="../controller/posts.inc.php" method="POST" enctype="multipart/form-data">

        <!-- Hidden Input Field With ID -->
        <input type="hidden" name="id" value="<?php echo ($row['post_id']) ? $row['post_id'] : ''; ?>">

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title<span class="text-danger">*</span> : </label>
            <input type="text" class="form-control" name="title" value="<?php echo ($row['post_title']) ? $row['post_title'] : ''; ?>">
        </div>
        <!-- Description -->
        <div class="mb-3">
            <label for="content">Description<span class="text-danger">*</span> : </label>
            <textarea class="ckeditor" name="content" id="content"><?php echo ($row['post_content']) ? $row['post_content'] : ''; ?></textarea>
        </div>
        <!-- Featured Image -->
        <div class="form-group">
            <label for="author">Featured Image : </label>
            <input type="hidden" name="current_featured_image" value="<?= ($row['post_featured_image'])? $row['post_featured_image']: ''; ?>">
            <input type="file" class="btn btn-light bg-white btn-block border" name="photo">
            <?php
                if($row['post_featured_image']){
                    echo "Current Image : " . $row['post_featured_image'];
                }
            ?>
        </div>
        <!-- Author -->
        <div class="form-group">
            <label for="author">Author<span class="text-danger">*</span> : </label>
            <input type="text" class="form-control" name="author" value="<?php echo ($row['post_author']) ? $row['post_author'] : ''; ?>">
        </div>
        <!-- Comment Status -->
        <div class="form-group">
            <label>Allow Comments<span class="text-danger">*</span> : </label><br>
        
            <label class="radio-inline mr-2">
                <input type="radio" name="comment_status" value="1" <?= ($row['comment_status']) == 0? '': 'checked'; ?>> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="comment_status" value="0" <?= ($row['comment_status']) == 0? "checked": ''; ?>> No
            </label>
        </div>

        <button type="submit" name="update" class="btn btn-primary pl-5 pr-5 rounded-0">Update</button>
        <button type="submit" name="updatedraft" class="btn btn-info px-3">Save as Draft</button>
        <a href="../controller/posts.inc.php?remove_featured=<?= $row['post_id'] ?>" class="btn btn-danger rounded-0">Remove Featured Image</a>
    </form>
</div>

<?php include_once __DIR__.'/../includes/footer.php'; ?>
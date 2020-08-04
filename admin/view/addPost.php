<?php 
    include_once __DIR__.'/../includes/header.php';
    include_once __DIR__.'/../model/users.class.php';
    
    include_once __DIR__.'/alert.php';

    //Getting User Data for User Name
    $user = new Users();
    $result = $user->ReadSingleUser('u_id', 1);
    $row = $result->fetch_assoc();
?>


<div>
    <form action="../controller/posts.inc.php" method="POST" enctype="multipart/form-data">
    <!-- Title -->
        <div class="form-group">
            <label for="title">Title<span class="text-danger">*</span> : </label>
            <input type="text" class="form-control" name="title" value="<?php echo (isset($_SESSION['title'])) ? $_SESSION['title'] : ''; ?>" required>
        </div>
        <!-- Description -->
        <div class="mb-3">
            <label for="content">Description<span class="text-danger">*</span> : </label>
            <textarea class="ckeditor" name="content" id="content" required><?php echo (isset($_SESSION['content'])) ? $_SESSION['content'] : ''; ?></textarea>
        </div>
        <!-- Featured Image -->
        <div class="form-group">
            <label for="author">Featured Image : </label>
            <input type="file" class="btn btn-block bg-white border" name="photo" value="<?php echo (isset($_SESSION['image'])) ? $_SESSION['image'] : ''; ?>">
        </div>
        <!-- Author -->
        <div class="form-group">
            <label for="author">Author<span class="text-danger">*</span> : </label>
            <input type="text" class="form-control" name="author" value="<?php echo (isset($_SESSION['author'])) ? $_SESSION['author'] : $row['u_name']; ?>" required>
        </div>
        <!-- Comment Status -->
        <div class="form-group">
            <label>Allow Comments<span class="text-danger">*</span> : </label><br>
        
            <label class="radio-inline mr-2">
                <input type="radio" name="comment_status" value="1" checked> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="comment_status" value="0" > No
            </label>
        </div>
        <button type="submit" name="insert" class="btn btn-primary pl-5 pr-5">Post</button>
        <button type="submit" name="draft" class="btn btn-info px-3">Save as Draft</button>
    </form>
</div>

<?php include __DIR__.'/../includes/footer.php'; ?>
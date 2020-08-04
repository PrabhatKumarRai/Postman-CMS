
<!-- Alert Section Starts -->
<?php
    if(isset($_SESSION['msg'])){
?>
    <div class="alert alert-<?= $_SESSION['class']; ?> alert-dismissible">
       <button type="button" class="close" data-dismiss="alert">x</button>
       <span class="text-uppercase"><strong><?= $_SESSION['class']; ?>!</strong></span>
       <?= $_SESSION['msg']; ?>
    </div>
<?php
    }
    unset($_SESSION['msg']);
    unset($_SESSION['class']);
?>
<!-- Alert Section Ends -->
<?php
session_start();

include_once __DIR__.'/../model/comment.class.php';
include_once __DIR__.'/../model/users.class.php';

//-------------Comment Section-------------//
//Insert Comment
if(isset($_POST['insertcomment'])){
    $post_id = htmlentities($_POST['post_id']);
    $newComment = htmlentities($_POST['newcomment']);

    if(empty($post_id) || empty($newComment)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postDetail.php?id=$post_id&comment=$newComment");
        exit;
    }

    //Getting the user name (admin name)
    $user = new Users();
    $result = $user->ReadSingleUser('u_id', 1);
    $row = $result->fetch_assoc();


    $comment = new Comment();
    $result = $comment->SetComment($post_id, $row['u_name'], $row['u_email'], $newComment, '1');      //Here, '1' means comment by admin

    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postDetail.php?id=$post_id&comment=$newComment");
        exit;
    }
    else{
        $_SESSION['msg'] = "Commented Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/postDetail.php?id=$post_id");
        exit;
    }

}

//Edit Comment
elseif(isset($_POST['editcomment'])){
    $comment_id = htmlentities($_POST['c_id']);
    $post_id = htmlentities($_POST['post_id']);
    $newcomment = htmlentities($_POST['newcomment']);

    if(empty($comment_id) || empty($post_id) || empty($newcomment)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postdetail.php?id=$post_id");
        exit;
    }

    $comment = new Comment();
    $result = $comment->UpdateComment($comment_id, $newcomment);
    
    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postDetail.php?id=$post_id");
        exit;
    }
    else{
        $_SESSION['msg'] = "Comment Updated Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/postDetail.php?id=$post_id");
        exit;
    }
}

//Delete Comment
elseif(isset($_POST['deletecomment'])){
    $comment_id = htmlentities($_POST['c_id']);
    $post_id = htmlentities($_POST['post_id']);

    if(!empty($comment_id) && !empty($post_id)){
        $delete = new Comment();
        $result = $delete->DeleteComment($comment_id);

        if($result == '0'){
            $_SESSION['msg'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/postDetail.php?id=$post_id");
            exit;
        }
        else{
            $_SESSION['msg'] = "Comment Deleted Successfully!!!";
            $_SESSION['class'] = "success";
            header("Location: ../view/postDetail.php?id=$post_id");
            exit;
        }
    }
}

//-------------Reply Section-------------//
//Insert Reply
elseif(isset($_POST['insertreply'])){
    $post_id = htmlentities($_POST['post_id']);
    $comment_id = htmlentities($_POST['c_id']);
    $newreply = htmlentities($_POST['newreply']);

    if(empty($comment_id) || empty($newreply)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postDetail.php?id=$post_id&comment=$newreply");
        exit;
    }

    //Getting the user name (admin name)
    $user = new Users();
    $result = $user->ReadSingleUser('u_id', 1);
    $row = $result->fetch_assoc();

    $comment = new Comment();
    $result = $comment->SetReply($comment_id, $row['u_name'], $row['u_email'], $newreply, '1');    //Here, '1' means reply by admin

    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postDetail.php?id=$post_id&comment=$newreply");
        exit;
    }
    else{
        $_SESSION['msg'] = "Replied Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/postDetail.php?id=$post_id");
        exit;
    }

}

//Edit Reply
elseif(isset($_POST['editreply'])){
    $reply_id = htmlentities($_POST['cr_id']);
    $post_id = htmlentities($_POST['post_id']);
    $newreply = htmlentities($_POST['newreply']);

    if(empty($reply_id) || empty($post_id) || empty($newreply)){
        $_SESSION['msg'] = "Empty Fields!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postdetail.php?id=$post_id");
        exit;
    }

    $reply = new Comment();
    $result = $reply->UpdateReply($reply_id, $newreply);
    
    if($result == '0'){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: ../view/postDetail.php?id=$post_id");
        exit;
    }
    else{
        $_SESSION['msg'] = "Reply Updated Successfully!!!";
        $_SESSION['class'] = "success";
        header("Location: ../view/postDetail.php?id=$post_id");
        exit;
    }
}

//Delete Reply
elseif(isset($_POST['deletereply'])){
    $reply_id = htmlentities($_POST['cr_id']);
    $post_id = htmlentities($_POST['post_id']);

    if(!empty($reply_id) && !empty($post_id)){
        $delete = new Comment();
        $result = $delete->DeleteReply($reply_id);

        if($result == '0'){
            $_SESSION['msg'] = "SQL Error Occured!!!";
            $_SESSION['class'] = "danger";
            header("Location: ../view/postDetail.php?id=$post_id");
            exit;
        }
        else{
            $_SESSION['msg'] = "Comment Reply Deleted Successfully!!!";
            $_SESSION['class'] = "success";
            header("Location: ../view/postDetail.php?id=$post_id");
            exit;
        }
    }
}

else{
    header("Location: ../");
    exit;
}
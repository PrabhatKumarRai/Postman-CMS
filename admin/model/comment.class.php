<?php

require_once __DIR__.'/db.class.php';

class Comment extends Db{
    
    //-----------------Insert Section-----------------//

    //New Comment
    public function SetComment($post_id, $name, $email, $comment, $commentAdmin="1"){
        $sql = "INSERT INTO post_comment (post_id, c_name, c_email, c_comment, c_admin) VALUES (?, ?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isssi', $post_id, $name, $email, $comment, $commentAdmin);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }

    //Comment Reply
    public function SetReply($comment_id, $name, $email, $reply, $replyAdmin="1"){
        $sql = "INSERT INTO post_comment_reply (c_id, cr_name, cr_email, cr_reply, cr_admin) VALUES (?, ?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isssi', $comment_id, $name, $email, $reply, $replyAdmin);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }

    //-----------------Select Section-----------------//

    //Get All Comment
    public function GetAllCommentReverse(){
        $sql = "SELECT * FROM post_comment ORDER BY c_id DESC;";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';
            }
            else{
                return $result;
            }
        }
        else{
            return '0';
        }
    }

    //Get Last 7 Days Comment
    public function GetSevenDaysComment(){
        $sql = "SELECT * FROM post_comment WHERE c_date >= (DATE(NOW()) - INTERVAL 7 DAY) ORDER BY c_id DESC;";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';
            }
            else{
                return $result;
            }
        }
        else{
            return '0';
        }
    }

    //Get Latest Post Comments
    public function GetLatestPostComments($post_id){
        $sql = "SELECT * FROM post_comment WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $post_id);

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';
            }
            else{
                return $result;
            }
        }
        else{
            return '0';
        }
    }


    //Get All Reply
    public function GetReply($comment_id){
        $sql = "SELECT * FROM post_comment_reply WHERE c_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $comment_id);

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';
            }
            else{
                return $result;
            }
        }
        else{
            return '0';
        }
    }

    //-----------------Update Section-----------------//

    //Update Comment
    public function UpdateComment($comment_id, $comment){
        $sql = "UPDATE post_comment SET c_comment=? WHERE c_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $comment, $comment_id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Update Reply    
    public function UpdateReply($reply_id, $reply){
        $sql = "UPDATE post_comment_reply SET cr_reply=? WHERE cr_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $reply, $reply_id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //-----------------Delete Section-----------------//

    //Delete Comment
    public function DeleteComment($comment_id){
        $sql = "DELETE FROM post_comment WHERE c_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $comment_id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Delete Reply    
    public function DeleteReply($reply_id){
        $sql = "DELETE FROM post_comment_reply WHERE cr_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $reply_id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }
    
}
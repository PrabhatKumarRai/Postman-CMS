<?php

require_once __DIR__.'/db.class.php';

class Comment extends Db{

    //-----------------Insert Section-----------------//

    //New Comment
    public function SetComment($post_id, $name, $email, $comment){
        $sql = "INSERT INTO post_comment (post_id, c_name, c_email, c_comment) VALUES (?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isss', $post_id, $name, $email, $comment);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }

    //Comment Reply
    public function SetReply($comment_id, $name, $email, $reply){
        $sql = "INSERT INTO post_comment_reply (c_id, cr_name, cr_email, cr_reply) VALUES (?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isss', $comment_id, $name, $email, $reply);

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
        $stmt = $this->conn->prepare($sql);

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
            return 0;
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
            return 0;
        }
    }
}

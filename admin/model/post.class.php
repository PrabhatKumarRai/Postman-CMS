<?php

require_once __DIR__.'/db.class.php';

class Post extends Db{
    
    //-------------------------------INSERT OPERATION-------------------------------//

    //Create Post Method Section
    public function InsertPost($title, $content, $image, $author, $localpath, $comment_status='1', $draft='0'){
        $sql = "INSERT INTO posts (post_title, post_content, post_featured_image, post_author, local_path, comment_status, draft) VALUES (?, ?, '$image', ?, '$localpath', ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssii', $title, $content, $author, $comment_status, $draft);

        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }

    //Draft Post Method Section
    public function DraftPost($title, $content, $image, $author, $localpath, $comment_status='1', $draft='1'){
        $sql = "INSERT INTO posts (post_title, post_content, post_featured_image, post_author, local_path, comment_status, draft) VALUES (?, ?, '$image', ?, '$localpath', ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssii', $title, $content, $author, $comment_status, $draft);

        if($stmt->execute()){
            return 1;       //Success
        }
        else{
            return 0;       //SQL ERROR
        }
    }


    //-------------------------------SELECT OPERATION-------------------------------//

    //Read All Post Method Section
    public function ReadAllPost(){
        $sql = "SELECT * FROM posts;";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }
    
    //Read All Post Reverse Method Section
    public function ReadAllPostReverse(){
        $sql = "SELECT * FROM posts ORDER BY post_id DESC;";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //Read Single POST Method Section
    public function ReadSinglePost($parameter, $value){
        $sql = "SELECT * FROM posts WHERE $parameter = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $value);

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }

    }

    //Search Post Method Section
    public function SearchPost($search){
        $sql = "SELECT * FROM posts WHERE post_date LIKE '%$search%' OR post_author LIKE '%$search%' OR post_title LIKE '%$search%'  OR post_content LIKE '%$search%' ORDER BY post_id DESC;";
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //Read Latest Post Method Section
    public function ReadLatestPost(){
        $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 1;";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //Read Filtered Post Method Section
    public function ReadFilteredPost($filteredid){
        $sql = "SELECT * FROM posts WHERE post_id IN (?) ORDER BY post_id DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $filteredid);
        
        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //Read Draft Post Method Section
    public function ReadDraftPost(){
        $sql = "SELECT * FROM posts WHERE draft=1 ORDER BY post_id DESC;";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }

    //-------------------------------UPDATE OPERATION-------------------------------//

    //Update Post Method Section
    public function UpdatePost($id, $title, $content, $image, $author, $localpath, $comment_status, $draft='0'){
        $sql = "UPDATE posts SET post_title=?, post_content=?, post_featured_image='$image', post_author=?, local_path='$localpath',comment_status=?, draft=? WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssiii', $title, $content, $author, $comment_status, $draft, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    
    //Update Post Draft Method Section
    public function UpdatePostDraft($id, $title, $content, $image, $author, $localpath, $comment_status, $draft='1'){
        $sql = "UPDATE posts SET post_title=?, post_content=?, post_featured_image='$image', post_author=?, local_path='$localpath',comment_status=?, draft=? WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssiii', $title, $content, $author, $comment_status, $draft, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Remove Featured Image Method Section
    public function RemoveFeatured($id){
        $sql = "UPDATE posts SET post_featured_image='' WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    
    //-------------------------------DELETE OPERATION-------------------------------//

    //Delete Single Post Method Section
    public function DeletePost($id){
        $sql = "DELETE FROM posts WHERE post_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }
}
<?php

require_once __DIR__.'/db.class.php';

class Post extends Db{

    //Read All Post Method Section
    public function ReadAllPost(){
        $sql = "SELECT * FROM posts WHERE draft=0;";
        $stmt = $this->conn->prepare($sql);

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

    //Read All Post Reverse Method Section
    public function ReadAllPostReverse(){
        $sql = "SELECT * FROM posts WHERE draft=0 ORDER BY post_id DESC;";
        $stmt = $this->conn->prepare($sql);

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

    //Read Latest Post Method Section
    public function ReadLatestPost(){
        $sql = "SELECT * FROM posts WHERE draft=0 ORDER BY post_id DESC LIMIT 1;";
        $stmt = $this->conn->prepare($sql);

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
        $sql = "SELECT * FROM posts WHERE draft=0 AND post_date LIKE '%$search%' OR post_author LIKE '%$search%' OR post_title LIKE '%$search%'  OR post_content LIKE '%$search%' ORDER BY post_date DESC;";
        
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
}

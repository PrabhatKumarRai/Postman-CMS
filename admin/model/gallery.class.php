<?php

require_once __DIR__.'/db.class.php';

class Gallery extends Db{

    //----------Insert Method Section----------//
    public function SetImage($image, $caption='', $localpath){
        $sql = "INSERT INTO gallery (image, caption, local_path) VALUES (?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $image, $caption, $localpath);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //----------Select Method Section----------//
    public function GetImage(){
        $sql = "SELECT * FROM gallery ORDER BY id DESC;";
        
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

    //----------Select Single Method Section----------//
    public function GetSingleImage($id){
        $sql = "SELECT * FROM gallery WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

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

    //----------Update Method Section----------//
    public function UpdateImage($id, $caption){
        $sql = "UPDATE gallery SET caption=? WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $caption, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //----------Delete Method Section----------//
    public function DeleteImage($id){
        $sql = "DELETE FROM gallery WHERE id=?;";
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
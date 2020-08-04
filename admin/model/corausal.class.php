<?php

require_once __DIR__.'/db.class.php';

class Corausal extends Db{

    //----------Insert Method Section----------//
    public function SetImage($image, $localpath){
        $sql = "INSERT INTO corausal (image, local_path) VALUES (?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $image, $localpath);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //----------Select Method Section----------//
    public function GetImage(){
        $sql = "SELECT * FROM corausal ORDER BY id DESC;";
        
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
        $sql = "SELECT * FROM corausal WHERE id=$id;";
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

    //----------Delete Method Section----------//
    public function DeleteImage($id){
        $sql = "DELETE FROM corausal WHERE id=?;";
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
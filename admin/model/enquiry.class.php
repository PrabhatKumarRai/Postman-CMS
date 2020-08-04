<?php

require_once __DIR__.'/db.class.php';

class Enquiry extends Db{


    //------------------Select Section-------------------//

    //Select All Enquiry Method Section
    public function GetAllEnquiry(){
        $sql = "SELECT * FROM enquiry ORDER BY id DESC;";

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
    
    //Select All Unread Enquiry Method Section
    public function GetAllUnreadEnquiry(){
        $sql = "SELECT * FROM enquiry WHERE reply='' ORDER BY id DESC;";

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

    //Select Single Enquiry Method Section
    public function GetSingleEnquiry($id){
        $sql = "SELECT * FROM enquiry WHERE id=?;";
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

    //------------------Update Section-------------------//
    public function UpdateReply($id, $reply){
        $sql = "UPDATE enquiry SET reply=? WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $reply, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }

    public function RemoveReply($id){
        $sql = "UPDATE enquiry SET reply='' WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }


    //---------------Delete Method Section----------------//
    public function DeleteEnquiry($id){
        $sql = "DELETE FROM enquiry WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }

}

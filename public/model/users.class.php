<?php

require_once __DIR__.'/db.class.php';


class Users extends Db{

    //--------------------------- Read Operation ---------------------------//
    
    //Read All Users Data Method
    public function ReadAllUser(){
        $sql = "SELECT * FROM users;";
        $stmt = $this->conn->prepare($sql);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';       //No Records Found   
            }
            else{
                return $result;     //Success
            }
        }
        else{
            return '0';       //SQL Error
        }
    }

    //Read Single User Data Method
    public function ReadSingleUser($parameter, $value){
        $sql = "SELECT * FROM users WHERE $parameter=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $value);

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows < 1){
                return '';       //No Records Found   
            }
            else{
                return $result;     //Success
            }
        }
        else{
            return '0';       //SQL Error
        }
    }


}
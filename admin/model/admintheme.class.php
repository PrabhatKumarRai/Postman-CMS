<?php

require_once __DIR__.'/db.class.php';

class Admintheme extends Db{
    
    //----------------Read Method Section-------------------//
    //Read Admin Panel Theme Method
    public function ReadAdminTheme($id=1){
        $sql = "SELECT * FROM admintheme WHERE id=$id;";

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

    //Get Sidebar Position
    public function GetSidebarPos($id=1){
        $sql = "SELECT sidebar_position FROM admintheme WHERE id=$id";
        if($result = $this->conn->query($sql)){
            return $result;
        }
        else{
            return '0';
        }
    }



    //----------------Update method Section-----------------//

    //Update Admin Panel Theme Method
    public function UpdateAdminTheme($name, $bg, $id=1){
        $sql = "UPDATE admintheme SET sidebarcolor=?, sidebarbg=? WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $name, $bg, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    //Update Admin Panel Theme Method
    public function SetSidebarPos($position, $id=1){
        $sql = "UPDATE admintheme SET sidebar_position=? WHERE id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $position, $id);
        
        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

}
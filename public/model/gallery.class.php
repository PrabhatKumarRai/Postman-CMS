<?php

require_once __DIR__.'/db.class.php';

class Gallery extends Db{

    //----------Select Method Section----------//

    //Get All Images
    public function GetImage(){
        $sql = "SELECT * FROM gallery ORDER BY id DESC;";
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

    //Get Ten Images
    public function GetTenImage(){
        $sql = "SELECT * FROM gallery ORDER BY date DESC LIMIT 10;";
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

}

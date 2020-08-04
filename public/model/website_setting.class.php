<?php

require_once __DIR__.'/db.class.php';

class Website_setting extends Db{

    //Get Website Setting
    public function GetWebsiteSetting(){
        $sql = "SELECT * FROM website_setting WHERE id=1;";

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
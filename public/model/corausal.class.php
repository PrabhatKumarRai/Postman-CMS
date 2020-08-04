<?php

require_once __DIR__.'/db.class.php';

class Corausal extends Db{

    //----------Select Method Section----------//
    public function GetImage(){
        $sql = "SELECT * FROM corausal ORDER BY date DESC;";
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
            return '0';
        }
    }

}

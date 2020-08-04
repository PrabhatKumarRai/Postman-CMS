<?php

require_once __DIR__.'/db.class.php';

class Enquiry extends Db{

    //------------------Insert Section-------------------//

    //Insert Enquiry Method Section
    public function InsertEnquiry($name, $email, $subject, $enquiry){
        $sql = "INSERT INTO enquiry (name, email, subject, enquiry) VALUES (?, ?, ?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $email, $subject, $enquiry);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }

}

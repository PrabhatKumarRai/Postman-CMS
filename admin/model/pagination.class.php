<?php

include_once __DIR__.'/db.class.php';

class Pagination extends Db {

    // find out the number of results stored in database
    public function ResultCount($table_name, $result_per_page){
        $sql="SELECT count(*) FROM $table_name";
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

    // retrieve the results from the database
    public function GetRecords($table_name, $result_per_page, $current_page_first_result, $db_date_col_name){
        
        $sql="SELECT * FROM $table_name ORDER BY $db_date_col_name LIMIT $current_page_first_result, $result_per_page";
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

}
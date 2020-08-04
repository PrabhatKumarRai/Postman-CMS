<?php

require_once __DIR__.'/db.class.php';

class Website_setting extends Db{
    
    //Get Website Setting
    public function GetWebsiteSetting(){
        $sql = "SELECT * FROM website_setting";

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
    
    //Update Website Theme
    public function UpdateTheme($theme){
        $sql = "UPDATE website_setting SET theme=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $theme);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    //Update Website Theme Color
    public function UpdateThemeColor($ColorName, $color){
        $sql = "UPDATE website_setting SET theme_color_name=?, theme_color=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $ColorName, $color);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

}
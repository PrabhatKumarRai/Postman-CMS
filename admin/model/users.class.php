<?php

require_once __DIR__.'/db.class.php';


class Users extends Db{

    //--------------------------- Insert Operation ---------------------------//

    //Signup Method  (Currently Not in use)
    public function InsertUser($username, $password, $designation, $dob, $localpath){
        $sql = "INSERT INTO users (u_uname, u_pass, u_designation, u_dob, local_path) VALUES ('$username', '$password,' '$designation', '$dob', '$localpath');";
        if($this->conn->query($sql)){
            return 1;       //Success
        }
        else{
            return 0;       //SQL Error
        }
    }

    //--------------------------- Read Operation ---------------------------//
    
    //Read All Users Data Method
    public function ReadAllUser(){
        $sql = "SELECT * FROM users;";
        if($result = $this->conn->query($sql)){
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

    //Select User based on username & Password (***** Login Method *****)
    public function ReadSingleUserLogin($username, $password){
        $sql = "SELECT * FROM users WHERE u_uname=? AND u_pass=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $username, $password);

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


    //--------------------------- Update Operation ---------------------------//

    //Update Account Info Method
    public function UpdateUserAccountInfo($id, $name, $designation, $dob, $mobile, $about, $image, $localpath){        
        $sql = "UPDATE users SET u_name=?, u_designation=?, u_dob=?, u_mobile=?, u_about=?, u_image='$image', local_path='$localpath' WHERE u_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssi', $name, $designation, $dob, $mobile, $about, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Update Social Info Method
    public function UpdateUserSocialInfo($id, $facebook, $twitter, $instagram, $email){
        $sql = "UPDATE users SET u_facebook=?, u_twitter=?, u_instagram=?, u_email=? WHERE u_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssi', $facebook, $twitter, $instagram, $email, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //Update Privacy Info Method
    public function UpdateUserPrivacyInfo($id, $password){
        $sql = "UPDATE users SET u_pass=? WHERE u_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $password, $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    //Remove Profile Image Method
    public function RemoveProfileImg($id, $image=''){
        $sql = "UPDATE users SET u_image='$image' WHERE u_id=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

    //--------------------------- Delete Operation ---------------------------//

    //Delete User Method (Currently not in use)
    public function DeleteUser($id){
        $sql = "DELETE FROM users WHERE u_id=$id;";
        if($this->conn->query($sql)){
            return 1;
        }
        else{
            return 0;
        }
    }


}
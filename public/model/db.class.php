<?php

require_once __DIR__.'/../../config/config.php';

class Db{
    protected $conn;
    protected $host = DEFAULT_HOST_NAME;
    protected $username = DEFAULT_USER_NAME;
    protected $password = DEFAULT_PASSWORD;
    protected $dbname = DEFAULT_DB_NAME;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if($this->conn->connect_error){
            die("<h3>Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 30/8/18
 * Time: 11:49 AM
 */

class db_connect
{
    public $conn = '';

    function __construct()
    {
    }

    function __destruct()
    {
        $this->close();
    }

    function connect(){
        require_once __DIR__ . "/db_config.php";

        $this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        ob_start();

        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        if($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    function close(){
        $this->conn->close;
    }
}
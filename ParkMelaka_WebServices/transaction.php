<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 12/9/18
 * Time: 3:45 AM
 */

class transaction
{
    //Database connection link
    private $conn;

    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once __DIR__ . '/db_connect.php';

        //Creating a DbConnect object to connect to the database
        $db = new db_connect();

        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->conn = $db->connect();
    }

    /*
    * The read operation
    * When this method is called it is returning the existing record of the database
    */
    function startTransaction($user_id, $loc)
    {
        $stmt = $this->conn->prepare("INSERT INTO transaction (trans_user_id, trans_start, trans_starttime, trans_loc, trans_active) VALUES (?, ?, ?, ?, 1);");

        $date = date("Y-m-d");
        $time = date("H:i");

        $stmt->bind_param("issi", $user_id, $date, $time, $loc);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
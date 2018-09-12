<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 11/9/18
 * Time: 11:10 PM
 */

class location
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
    function getLocation($loc_council, $loc_state)
    {
        $stmt = $this->conn->prepare("SELECT id, loc_name FROM location WHERE loc_council=? AND loc_state=?;");
        $stmt->bind_param("ss", $loc_council, $loc_state);
        $stmt->execute();
        $stmt->bind_result($id, $loc);

        $locations = array();

        while($stmt->fetch()){
            $location  = array();
            $location['id'] = $id;
            $location['loc_name'] = $loc;

            array_push($locations, $location);
        }

        return $locations;

        $stmt->close();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 2/9/18
 * Time: 4:28 PM
 */

class users
{
    //Database connection link
    private $conn;

    //Class constructor
    function __construct(){
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
    function getUserPassword($user_email, $user_password){
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE user_email=? AND user_password=?;");
        $stmt->bind_param("ss",$user_email, $user_password);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        list($id) = $result->fetch_row();

        return $id;
    }

    function getUserDetail($user_id){
        $stmt = $this->conn->prepare("SELECT id, user_email, user_name, user_balance, car_plate_number FROM users WHERE id=?;");
        $stmt->bind_param("s",$user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $user  = array();

        list($user['id'], $user['email'], $user['user_name'], $user['user_balance'], $user['car_number']) = $result->fetch_row();

        return $user;
    }

    function checkEmailExists($email){
        $stmt = $this->conn->prepare("SELECT COUNT(1) FROM users WHERE user_email = ?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        list($exists) = $result->fetch_row();

        return $exists;
    }

    function createUser($name, $email, $password, $carPlate){
        $stmt = $this->conn->prepare("INSERT INTO users (user_email, user_password, user_name, user_balance, car_plate_number) VALUES (?, ?, ?, 0.00, ?);");
        $stmt->bind_param("ssss", $email, $password, $name, $carPlate);
        if($stmt->execute()){
            return "1";
        }
        return "0";
    }
}
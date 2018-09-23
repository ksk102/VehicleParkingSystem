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

    function startTransaction($user_id, $loc)
    {
        $stmt = $this->conn->prepare("INSERT INTO transaction (trans_user_id, trans_start, trans_starttime, trans_loc_id, trans_active) VALUES (?, ?, ?, ?, 1);");

        $date = date("Y-m-d");
        $time = date("H:i");

        $stmt->bind_param("issi", $user_id, $date, $time, $loc);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function endTransaction($user_id)
    {
        $stmt = $this->conn->prepare("SELECT trans_start, trans_starttime, location.loc_name, users.car_plate_number, users.user_balance
                                            FROM transaction
                                            INNER JOIN location ON location.trans_loc_id = transaction.trans_loc_id
                                            INNER JOIN users ON users.id = transaction.trans_user_id
                                            WHERE trans_user_id = ? AND trans_active = 1;");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        list($sdate, $stime, $loc, $carno, $balance) = $result->fetch_row();

        $stmt = $this->conn->prepare("UPDATE transaction
        SET trans_active = 0, trans_end = ?, trans_endtime = ?
        WHERE trans_user_id = ? AND trans_active = 1;");

        $date = date("Y-m-d");
        $time = date("H:i");

        $stmt->bind_param("sss", $date, $time, $user_id);
        if($stmt->execute()){
            $duration  = array();
            $duration['id'] = $user_id;
            $duration['sdate'] = $sdate;
            $duration['stime'] = $stime;
            $duration['edate'] = $date;
            $duration['etime'] = $time;
            $duration['loc'] = $loc;
            $duration['carno'] = $carno;
            $duration['balance'] = $balance;

            return $duration;
        }
        return null;
    }

    function updateBalance($user_id, $balance){
        $stmt = $this->conn->prepare("UPDATE users
                                            SET user_balance = ?
                                            WHERE id = ?;");

        $stmt->bind_param("ss", $balance, $user_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function updateCharges($user_id, $amount){
        $stmt = $this->conn->prepare("UPDATE transaction SET trans_amount = ? WHERE trans_user_id = ? AND trans_amount IS NULL;");

        $stmt->bind_param("ss", $amount, $user_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function getHistoryList($userId){
        $stmt = $this->conn->prepare("SELECT trans_user_id, trans_start, trans_starttime, trans_end, trans_endtime, loc_name, trans_amount, car_plate_number
FROM transaction
INNER JOIN location ON location.trans_loc_id = transaction.trans_loc_id
INNER JOIN users ON users.id = transaction.trans_user_id
WHERE trans_user_id = ? AND trans_active = 0
ORDER BY trans_start DESC, trans_starttime DESC;");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $stmt->bind_result($id, $startDate, $startTime, $endDate, $endTime, $location, $amount, $carNo);

        $histories = array();

        while($stmt->fetch()){

            $history  = array();
            $history['id'] = $id;
            $history['startDate'] = $startDate;
            $history['startTime'] = $startTime;
            $history['endDate'] = $endDate;
            $history['endTime'] = $endTime;
            $history['location'] = $location;
            $history['amount'] = $amount;
            $history['carNo'] = $carNo;

            array_push($histories, $history);
        }
        return $histories;
    }

    function createTopUpRequest($amount,$email){
        $stmt = $this->conn->prepare("UPDATE users SET user_top_up = ? WHERE user_email = ?;");

        $stmt->bind_param("is", $amount, $email);
        if($stmt->execute()){
            return "1";
        }
        return "0";
    }
}
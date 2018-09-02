<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 30/8/18
 * Time: 12:03 PM
 */

    require_once 'general.php'; //database connection

    $response = array();

    // post data
    $user_email = $_POST["username"];
    $user_password = $_POST["password"];

    // sql statement
    $stmt = $conn->prepare("SELECT COUNT(1) AS count FROM users WHERE user_email=? AND user_password=?;");
    $stmt->bind_param("ss",$user_email, $user_password);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt->close();

    list($count) = $result->fetch_row();

    // json encode
    if($count == 1){
        $response["success"] = 1;
        $response["user_exist"] = 1;

        echo json_encode($response);
    }
    else{
        $response["success"] = 1;
        $response["user_exist"] = 0;

        echo json_encode($response);
    }
?>
<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 30/8/18
 * Time: 3:10 PM
 */

// database connection
require_once __DIR__ . '/db_connect.php';
$conn = new db_connect();
$conn = $conn->connect();

//set time zone
date_default_timezone_set("Asia/Kuala_Lumpur");

/*turn off E_NOTICE error reporting*/
error_reporting(E_ALL & ~E_NOTICE);

/*fields name = php variable name*/
if(isset($_GET)){
    while(list($var, $val)=each($_GET)){
        $$var=$val;
    }
}

if(isset($_POST)){
    while(list($var, $val)=each($_POST)){
        $$var=$val;
    }
}

if(isset($_COOKIE)){
    while(list($var, $val)=each($_COOKIE)){
        $$var=$val;
    }
}

if(isset($_SERVER)){
    while(list($var, $val)=each($_SERVER)){
        $$var=$val;
    }
}
/*end fields name = php variable name*/
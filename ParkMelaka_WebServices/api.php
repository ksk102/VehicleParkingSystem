<?php
/**
 * Created by PhpStorm.
 * User: kskoh
 * Date: 2/9/18
 * Time: 4:17 PM
 */

// function validating all the paramters are available
// we will pass the required parameters to this function
function isTheseParametersAvailable($params){
    //assuming all parameters are available
    $available = true;
    $missingparams = "";

    foreach($params as $param){
        if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
            $available = false;
            if($missingparams == ""){
                $missingparams = $param;
            }
            else{
                $missingparams = $missingparams . " & " . $param;
            }
        }
    }

    //if parameters are missing
    if(!$available){
        $response = array();
        $response['success'] = 0;
        $response['message'] = substr($missingparams, 0, strlen($missingparams)) . ' is required';

        //displaying error
        echo json_encode($response);

        //stopping further execution
        die();
    }
}

//an array to display response
$response = array();

// if it is an api call
// that means a get parameter named api is set in the URL
// and with this parameter we are concluding that it is an api call
if(isset($_GET['api'])){

    switch($_GET['api']){
        //the READ operation
        //if the call is getUserPassword
        case 'getUserPassword':
            isTheseParametersAvailable(array('email','password'));

            require_once 'users.php';
            $users = new users();

            $success = "1";
            $user_exists = $users->getUserPassword($_POST['email'], $_POST['password']);

            $response["success"] = $success;
            $response["user_exist"] = $user_exists;

            if($user_exists){
                $response['message'] = 'Login Successful';
            }
            else{
                $response['message'] = 'Login Failed! Please check your email and password again';
            }
            
            break;

        case 'getUserDetail':
            isTheseParametersAvailable(array('userid'));

            require_once 'users.php';
            $users = new users();

            $response['success'] = "1";
            $response['user_detail'] = $users->getUserDetail($_POST['userid']);

            break;

        case 'getLocation':
            require_once 'location.php';
            $loc = new location();

            $response['success'] = "1";
            $response['callback'] = "getLocation";
            $response['message'] = 'Request successfully completed';
            $response['locations'] = $loc->getLocation("MPHTJ", "Melaka");

            break;
    }

}
else{
    //if it is not api call
    //pushing appropriate values to response array
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

//displaying the response in json structure
echo json_encode($response);
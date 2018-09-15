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

        case 'startTransaction':
            isTheseParametersAvailable(array('user_id', 'parking_location'));

            require_once 'transaction.php';
            $trans = new transaction();

            $result = $trans->startTransaction(
                $_POST['user_id'],
                $_POST['parking_location']
            );

            $response['callback'] = "startTransaction";

            if($result){
                $response['success'] = "1";
                $response['message'] = 'Transaction started successfully';
            }else{
                $response['success'] = "0";
                $response['message'] = 'Some error occurred please try again';
            }

            break;

        case 'endTransaction':
            isTheseParametersAvailable(array('user_id'));

            require_once 'transaction.php';
            $trans = new transaction();

            $response['callback'] = "endTransaction";
            $response['success'] = "1";
            $response['message'] = 'Transaction ended';
            $response['time'] = $trans->endTransaction($_POST['user_id']);

            if($response['time'] == null){
                $response['success'] = "0";
                $response['message'] = 'Some error occurred please try again';
            }

            break;

        case 'updateBalance':
            isTheseParametersAvailable(array('userId', 'balance'));

            require_once 'transaction.php';
            $trans = new transaction();

            $response['callback'] = "updateBalance";

            if($trans->updateBalance($_POST['userId'], $_POST['balance'])){
                $response['success'] = "1";
                $response['message'] = 'Successfully updated balance';
            }
            else{
                $response['success'] = "0";
                $response['message'] = 'Database error';
            }

            break;

        case 'updateCharges':
            isTheseParametersAvailable(array('userId', 'amount'));

            require_once 'transaction.php';
            $trans = new transaction();

            $response['callback'] = "updateCharges";

            if($trans->updateCharges($_POST['userId'], $_POST['amount'])){
                $response['success'] = "1";
                $response['message'] = 'Successfully updated amount';
            }
            else{
                $response['success'] = "0";
                $response['message'] = 'Database error';
            }

            break;

        case 'checkEmailExists':
            isTheseParametersAvailable(array('email'));

            require_once  'users.php';
            $users = new users();

            $response['callback'] = "checkEmailExists";
            $response['success'] = '1';
            $response['exists'] = $users->checkEmailExists($_POST['email']);

            break;

        case 'createUser':
            isTheseParametersAvailable(array('name', 'email', 'password', 'carPlate'));

            require_once  'users.php';
            $users = new users();

            $response['callback'] = "createUser";
            $response['success'] = $users->createUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['carPlate']);

            break;

        case'getHistoryList':
            isTheseParametersAvailable(array('userId'));

            require_once 'transaction.php';
            $trans = new transaction();

            $response['callback'] = "getHistoryList";
            $response['success'] = 1;
            $response['historyList'] = $trans->getHistoryList($_POST['userId']);

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
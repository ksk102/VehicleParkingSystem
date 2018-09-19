class topUp
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
	
	function requestTopUp($amount){
        $stmt = $this->conn->prepare("INSERT INTO users (user_email, user_password, user_name, user_balance, car_plate_number) VALUES (?, ?, ?, 0.00, ?);");

        $stmt->bind_param("ssss", $email, $password, $name, $carPlate);
        if($stmt->execute()){
            return "1";
        }
        return "0";
    }
	
}
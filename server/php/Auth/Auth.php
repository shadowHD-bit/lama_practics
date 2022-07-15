<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

//Import connection SQL Server
// require('../connect.php');

//Import metadata database table
$configTableDatabase = require('../configTableDatabase.php');

//Import metadata database
$config = require('../config.php');

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get data on client part
$_loginUserInForm = '';
$_passwordUserInForm = '';

//Check data
if(isset($data)){
    $_loginUserInForm = $data -> loginFetch;
    $_passwordUserInForm = $data -> passwordFetch;
}

//Get name user table
$userTable = $configTableDatabase['UserTable'];

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$resultAuthUser = $mysqlConnectForQuery->query("SELECT * FROM `$userTable` WHERE `login`='$_loginUserInForm' AND `password`= '$_passwordUserInForm'");

//Get data user in object
$dataUser = $resultAuthUser -> fetch_assoc();

//Check count result query
if ($resultAuthUser->num_rows == 0) {
    //HTTP code
    http_response_code(200);

    //Display error
    echo json_encode([
        'error' => true,
        'message' => 'User not found!',
    ]);

    $mysqlConnectForQuery->close();

} else {
    //HTTP code
    http_response_code(200);

    //Set COOKIE for save data this user
    setcookie('user_id', $dataUser['id_user'], time() + 220 * 8, "/");
    
    //Close connect database
    $mysqlConnectForQuery->close();

    //Display ok status
    echo json_encode([
        'error' => false,
        'message' => 'Access'
    ]);
}


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

//Get name user table
$userTable = $configTableDatabase['UserTable'];

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get data on client part
$_mailChangeUser = '';
$_telChangeUser = '';

//Check data
if(isset($data)){
    $_mailChangeUser = $data -> mailFetch;
    $_telChangeUser = $data -> telFetch;
}
//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetUser = $mysqlConnectForQuery->query("UPDATE `$userTable` SET email = '$_mailChangeUser', phone_number = '$_telChangeUser' WHERE id_user = $cookieUserId");


$mysqlConnectForQuery->close();

?>
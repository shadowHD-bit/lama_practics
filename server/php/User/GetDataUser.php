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

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetUser = $mysqlConnectForQuery->query("SELECT * FROM `$userTable` WHERE id_user =$cookieUserId");

//Get result in right format
$dataUser = $GetUser -> fetch_assoc();

//Display data
echo json_encode($dataUser);

$mysqlConnectForQuery->close();
?>
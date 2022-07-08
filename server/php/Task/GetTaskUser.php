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

//Get name task table
$taskTable = $configTableDatabase['TaskTable'];
//Get name status table
$statusTable = $configTableDatabase['StatusTable'];

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetTask = $mysqlConnectForQuery->query("SELECT * FROM `$taskTable` INNER JOIN `$statusTable` ON `$taskTable`.id_status = `$statusTable`.id_status");

//Get result in right format
$resultGetTask = mysqli_fetch_all($GetTask, MYSQLI_ASSOC);

//Display error
echo json_encode($resultGetTask);

$mysqlConnectForQuery->close();
?>
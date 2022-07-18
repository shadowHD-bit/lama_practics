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

//Get name project table
$taskTable = $configTableDatabase['TaskTable'];
//Get name status table
$checklistPointTable = $configTableDatabase['ChecklistPointTable'];

//Variables data url server
$data = $_GET['dataId'];
//$data = file_get_contents('php://input');

//Get data on client part
$_idTaskPHP = $data;

//Check data

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetProject = $mysqlConnectForQuery->query("SELECT * FROM `$checklistPointTable`
                                            WHERE id_task = '$_idTaskPHP'");

//Get result in right format
$resultGetProject = mysqli_fetch_all($GetProject, MYSQLI_ASSOC);

//Display error
echo json_encode($resultGetProject);

$mysqlConnectForQuery->close();
?>
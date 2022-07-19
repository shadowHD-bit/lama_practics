<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

//Import connection SQL Server
// require('../connect.php');

//Import metadata database table
$configTableDatabase = require('../configTableDataBase.php');

//Import metadata database
$config = require('../configDatabase.php');

//Get name project table
$projectTable = $configTableDatabase['ProjectTable'];
//Get name status table
$statusTable = $configTableDatabase['StatusTable'];
$taskTable = $configTableDatabase['TaskTable'];

//Variables data url server

//Variables data url server
$data = $_GET['dataId'];
//$data = file_get_contents('php://input');

//Get data on client part
$_idProjectPHP = $data;

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetProject = $mysqlConnectForQuery->query("SELECT task_name, task_deadline, status_name FROM `$taskTable`
                                            INNER JOIN `$statusTable` on `$statusTable`.id_status = `$taskTable`.id_status
                                            WHERE `$taskTable`.id_project = '$_idProjectPHP'");

//Get result in right format
$resultGetProject = mysqli_fetch_all($GetProject, MYSQLI_ASSOC);

//Display error
echo json_encode($resultGetProject);

$mysqlConnectForQuery->close();
?>
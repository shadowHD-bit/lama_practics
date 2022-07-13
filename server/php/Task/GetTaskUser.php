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
$taskRoleTable = $configTableDatabase['TaskRoleTable'];
$userTable = $configTableDatabase['UserTable'];
$roleTable = $configTableDatabase['RoleTable'];
$projectTable = $configTableDatabase['ProjectTable'];

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetTask = $mysqlConnectForQuery->query("SELECT * FROM `$taskTable` INNER JOIN `$statusTable` ON `$taskTable`.id_status = `$statusTable`.id_status
                                                INNER JOIN `$taskRoleTable` ON `$taskRoleTable`.id_task = `$taskTable`.id_task
                                                INNER JOIN `$roleTable` ON `$roleTable`.id_role = `$taskRoleTable`.id_role
                                                INNER JOIN `$userTable` ON `$userTable`.id_user = `$taskRoleTable`.id_user
                                                INNER JOIN `$projectTable` ON `$projectTable`.id_project = `$taskTable`.id_project");

//Get result in right format
$resultGetTask = mysqli_fetch_all($GetTask, MYSQLI_ASSOC);

//Display error
echo json_encode($resultGetTask);

$mysqlConnectForQuery->close();
?>
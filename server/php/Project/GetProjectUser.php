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
$projectTable = $configTableDatabase['ProjectTable'];
//Get name status table
$statusTable = $configTableDatabase['StatusTable'];
$userTable = $configTableDatabase['UserTable'];
$userProjectTable = $configTableDatabase['UserProjectTable'];

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Connect data user in SQL Server
$mysqlConnectForQuery1 = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$mysqlConnectForQuery2 = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetProject = $mysqlConnectForQuery1->query("SELECT * FROM `$projectTable` 
                                            INNER JOIN `$statusTable` ON `$projectTable`.id_status = `$statusTable`.id_status
                                            INNER JOIN `$userProjectTable` ON `$userProjectTable`.id_project = `$projectTable`.id_project
                                            INNER JOIN `$userTable` ON `$userTable`.id_user = `$userProjectTable`.id_user
                                            WHERE `$userProjectTable`.id_user = '$cookieUserId'");
$GetCreator = $mysqlConnectForQuery2->query("SELECT * FROM `$projectTable` 
                                            INNER JOIN `$statusTable` ON `$projectTable`.id_status = `$statusTable`.id_status
                                            INNER JOIN `$userProjectTable` ON `$userProjectTable`.id_project = `$projectTable`.id_project
                                            INNER JOIN `$userTable` ON `$userTable`.id_user = `$userProjectTable`.id_user
                                            WHERE `$userProjectTable`.isCreator = 1");

//Get result in right format
$resultGetProject = mysqli_fetch_all($GetProject, MYSQLI_ASSOC);
$resultGetCreator = mysqli_fetch_all($GetCreator, MYSQLI_ASSOC);
$result = array_merge($resultGetCreator, $resultGetProject);

//Display error
echo json_encode($resultGetProject);

$mysqlConnectForQuery1->close();
?>
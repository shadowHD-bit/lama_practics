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

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get data on client part
$_idProjectPHP = '';

//Check data
if(isset($data)){
    $_idProjectPHP = $data -> dataId;
}

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$GetProject = $mysqlConnectForQuery->query("SELECT * FROM `$projectTable`
                                            INNER JOIN `$statusTable` ON `$statusTable`.id_status = `$projectTable`.id_status
                                            WHERE id_project = '$_idProjectPHP'");

//Get result in right format
$resultGetProject = mysqli_fetch_all($GetProject, MYSQLI_ASSOC);

//Display error
echo json_encode($resultGetProject);

$mysqlConnectForQuery->close();
?>
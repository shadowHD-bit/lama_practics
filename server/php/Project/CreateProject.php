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

//Get name project table
$projectUserTable = $configTableDatabase['UserProjectTable'];

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get data on client part
$_titleProject = '';
$_descriptionProject = '';
$_dateProject = '';
$_startDateProject = '';
$_usersArray = '';

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Check data
if(isset($data)){
    $_titleProject = $data -> titleProjectJS;
    $_descriptionProject = $data -> descProjectJS;
    $_dateProject = $data -> deadlineProjectJS;
    $_startDateProject = $data -> startDateProjectJS;
    $_usersArray = $data -> usersProjectJS;
}

$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$insertProject = $mysqlConnectForQuery->query("INSERT INTO `$projectTable` (id_status, project_name, project_start, project_deadline, project_description) VALUES (1,'$_titleProject', '$_startDateProject', '$_dateProject', '$_descriptionProject')");


$nameProject = $mysqlConnectForQuery->query("SELECT id_project FROM `$projectTable` WHERE project_name = '$_titleProject'");

//Get result in right format
$idProjectFromDatabase = $nameProject -> fetch_assoc();

$projectID = $idProjectFromDatabase['id_project'];

foreach ($_usersArray as $userID) {
    $mysqlConnectForQuery->query("INSERT INTO `$projectUserTable` (id_user, id_project, isCreator) VALUES ('$userID', '$projectID', 0)");
}
//Creator project
$mysqlConnectForQuery->query("INSERT INTO `$projectUserTable` (id_user, id_project, isCreator) VALUES ('$cookieUserId', '$projectID', 1)");

$mysqlConnectForQuery->close()

?>
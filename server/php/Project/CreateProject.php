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

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get data on client part
$_titleProject = '';
$_descriptionProject = '';
$_dateProject;

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];


//Check data
if(isset($data)){
    $_titleProject = $data -> titleProjectJS;
    $_descriptionProject = $data -> descProjectJS;
    $_dateProject = $data -> deadlineProjectJS;
}
$sqldate = $_dateProject;

$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$insertProject = $mysqlConnectForQuery->query("INSERT INTO `$projectTable` (id_user, id_status, project_name, project_deadline, project_description) VALUES ('$cookieUserId',1,'$_titleProject', '$sqldate', '$_descriptionProject')");

echo json_encode($data);




?>
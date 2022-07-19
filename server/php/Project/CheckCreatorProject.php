<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();

//Variables data url server
$id_project = $_GET['dataId'];

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];
$id_creator = $Project->getCreatorProjectByIdProject($id_project);

if($id_creator == $cookieUserId){
    echo json_encode('UserCreator');
}else{
    echo json_encode('UserNoCreator');
}
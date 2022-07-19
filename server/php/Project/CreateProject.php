<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Check data
if (isset($data)) {
    $_titleProject = $data->titleProjectJS;
    $_descriptionProject = $data->descProjectJS;
    $_dateProject = $data->deadlineProjectJS;
    $_startDateProject = $data->startDateProjectJS;
    $_usersArray = $data->usersProjectJS;
}

//Get tasks
echo $Project->createProject($_titleProject, $_descriptionProject, $_startDateProject, $_dateProject, $cookieUserId, $_usersArray);

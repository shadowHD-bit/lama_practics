<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();

//Variables data url server
$id_project = $_GET['projectid'];
$id_user = $_GET['userid'];
//Get tasks
echo $Project->addedUserInProject($id_project, $id_user);

<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();
//id=a&id=b
$project_id = $_GET['id_project'];
$project_status = $_GET['id_status'];

$Project->changeStatusProject($project_id, $project_status);

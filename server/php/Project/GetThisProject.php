<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();

//Variables data url server
$data = $_GET['dataId'];

//Get tasks
echo $Project->getOneProject($data);
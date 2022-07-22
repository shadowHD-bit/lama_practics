<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Get tasks
echo $Project->GetProjectUserCreator($cookieUserId);

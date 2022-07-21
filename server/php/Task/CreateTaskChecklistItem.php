<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

//Check data
if (isset($data)) {
    $_checklistPointValue = $data->valueJS;
    $_idTask = $data->taskId;
}

//Get tasks
echo $Task->createChecklistItem($_idTask, $_checklistPointValue);

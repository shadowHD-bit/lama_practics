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
    $_checklistPointId = $data->pointId;
    $_checkboxStatus = $data->checkboxStatus;
}

//Get tasks
echo $Task->updateChecklistItem($_checklistPointId, $_checkboxStatus);

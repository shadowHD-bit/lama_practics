<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();
//id=a&id=b
$task_id = $_GET['id_task'];
$task_status = $_GET['id_status'];

$Task->changeStatusTask($task_status, $task_id);

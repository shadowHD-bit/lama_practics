<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();
//id=a&id=b
$task_id = $_GET['dataId'];

echo $Task->getOneTask($task_id);

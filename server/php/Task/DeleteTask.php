<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();

//Variables data url server
$id_task = $_GET['taskid'];
//Get tasks
echo $Task->deleteTask($id_task);

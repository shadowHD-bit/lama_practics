<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();

//Variables data url server
$id_task = $_GET['taskid'];
$id_user = $_GET['userid'];
//Get tasks
echo $Task->delegate($id_user, $id_task);

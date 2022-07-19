<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();

//Get tasks
echo $Task->getAllTasks();

 
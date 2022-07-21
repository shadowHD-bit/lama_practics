<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();

$point_id = $_GET['pointId'];

echo $Task->deleteChecklistPoint($point_id);

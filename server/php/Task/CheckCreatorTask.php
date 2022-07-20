<?php
//Headers
require_once '../../utils/headers.php';

require_once '../../classes/Task.class.php';
$Task = new Task();

//Variables data url server
$id_task = $_GET['dataId'];

$cookieUserId = $_COOKIE['user_id'];
$id_creator = $Task->getCreatorTaskByIdTask($id_task);

if($id_creator == $cookieUserId){
    echo json_encode('UserCreator');
}else{
    echo json_encode('UserNoCreator');
}
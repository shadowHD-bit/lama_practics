<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Task.class.php';
$Task = new Task();

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Check data
if (isset($data)) {
    $_id_Task = $data->id_taskJS;
    $_titleTask = $data->titleTaskJS;
    $_descriptionTask = $data->descTaskJS;
    $_dateTask = $data->deadlineTaskJS;
}


if (!$_id_Task || !$_titleTask || !$_descriptionTask || !$_dateTask) {
    echo json_encode([
        'error' => true,
        'message' => 'Заполните все поля!',
    ]);
} else {
    //Get tasks
    $Task->updateDataTask($_id_Task, $_titleTask, $_descriptionTask, $_dateTask);
    echo json_encode([
        'error' => false,
    ]);
}

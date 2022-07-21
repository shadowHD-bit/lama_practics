<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Project.class.php';
$Project = new Project();

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Check data
if (isset($data)) {
    $_id_project = $data->id_project;
    $_titleProject = $data->titleProjectJS;
    $_descriptionProject = $data->descProjectJS;
    $_dateProject = $data->deadlineProjectJS;
    $_startDateProject = $data->startDateProjectJS;
}


if (!$_id_project || !$_titleProject || !$_descriptionProject || !$_dateProject || !$_startDateProject) {
    echo json_encode([
        'error' => true,
        'message' => 'Заполните все поля!',
    ]);
} else {
    //Get tasks
    $Project->updateDataProject($_id_project, $_titleProject, $_descriptionProject, $_dateProject, $_startDateProject);
    echo json_encode([
        'error' => false,
    ]);
}

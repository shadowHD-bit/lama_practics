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
    $_titleTask = $data->titleTaskJS;
    $_descriptionTask = $data->descTaskJS;
    $_dateTask = $data->deadlineTaskJS;
    $_thisTask = $data->thisTaskJS;
    $_invite = $data->inviteJS;
}

if (!$_titleTask || !$_descriptionTask || !$_dateTask || !$_invite) {
    echo json_encode([
        'error' => true,
        'message' => 'Заполните все поля!',
    ]);
} else {
    $Task->createUpperTask($_thisTask, $_titleTask, $_descriptionTask, $_dateTask, $_invite, $cookieUserId);
    echo json_encode([
        'error' => false,
    ]);
}

<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

//Check auth
if (!$_COOKIE['user_id']) {
    echo json_encode([
        'access' => false,
    ]);
}
else{
    echo json_encode([
        'access' => true,
    ]);
}
?>
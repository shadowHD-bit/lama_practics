<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json; charset=UTF-8');

    //Delete cookie
    setcookie("user_id", null, -1, '/');

?>
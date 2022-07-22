<?php
//Headers
require_once '../../utils/headers.php';

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//User class
require_once '../../classes/User.class.php';
$User = new User();

//Check data
if (isset($data)) {
    $_mailChangeUser = $data->mailFetch;
    $_telChangeUser = $data->telFetch;
}

$User->updateNumberPhone($_telChangeUser);
echo $User->updateMail($_mailChangeUser);

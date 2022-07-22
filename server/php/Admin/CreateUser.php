<?php
//Headers
require_once '../../utils/headers.php';

//Admin class
require_once '../../classes/Admin.class.php';
$Admin = new Admin();

//Variables data url server
$data = json_decode(file_get_contents('php://input'));

//Check data
if (isset($data)) {
    $_name = $data->name;
    $_lastname = $data->lastname;
    $_secondname = $data->secondname;
    $_tel = $data->tel;
    $_mail = $data->mail;
    $_date = $data->date;
    $_login = $data->login;
    $_password = $data->password;
}

if (!$_name || !$_lastname || !$_tel || !$_secondname || !$_mail || !$_date | !$_login || !$_password) {
    echo json_encode([
        'error' => true,
        'message' => 'Заполните все поля!',
    ]);
} else {
    $Admin->addNewUser($_name, $_lastname, $_secondname, $_tel, $_mail, $_date, $_login, $_password);
    echo json_encode([
        'error' => false,
    ]);
}

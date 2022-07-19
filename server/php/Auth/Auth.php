<?php
//Headers
require_once '../../utils/headers.php';

//Get data on client part
$data = json_decode(file_get_contents('php://input'));

//Check data
if(isset($data)){
    $_loginUserInForm = $data -> loginFetch;
    $_passwordUserInForm = $data -> passwordFetch;
}

//Auth class
require_once '../../classes/Auth.class.php';
$Auth = new Auth();

//Authentication user in system
if (isset($_loginUserInForm) && isset($_passwordUserInForm)) { 
    $Auth->setLogin($_loginUserInForm);
    $Auth->setPassword($_passwordUserInForm);
    echo $Auth->authenticationUser();
}
 
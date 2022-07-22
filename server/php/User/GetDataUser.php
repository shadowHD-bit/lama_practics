<?php
//Headers
require_once '../../utils/headers.php';

//User class
require_once '../../classes/User.class.php';
$User = new User();

//Get auth user id
$ID = $User->getCookieIdUser();

//Get tasks
echo $User->getDataOneUser($ID);

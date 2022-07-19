<?php
//Headers
require_once '../../utils/headers.php';

//User class
require_once '../../classes/User.class.php';
$User = new User();

//Query body
echo $User->getCookieIdUser();

<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/Auth.class.php';

//Logout
$Auth = new Auth();
echo $Auth->logoutUser();

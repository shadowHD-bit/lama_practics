<?php
//Headers
require_once '../../utils/headers.php';

//User class
require_once '../../classes/Admin.class.php';
$Admin = new Admin();

//Query body
echo $Admin->showUser();

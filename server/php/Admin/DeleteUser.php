<?php
//Headers
require_once '../../utils/headers.php';

//User class
require_once '../../classes/Admin.class.php';
$Admin = new Admin();

$id_user = $_GET['userid'];

//Query body
echo $Admin->deleteUser($id_user);

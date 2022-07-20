<?php
//Headers
require_once '../../utils/headers.php';

//Auth class
require_once '../../classes/User.class.php';

//Check auth
$User = new User();
echo $User->checkAdmin();

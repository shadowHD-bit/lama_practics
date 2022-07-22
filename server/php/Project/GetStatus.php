<?php
//Headers
require_once '../../utils/headers.php';

//Project class
require_once '../../classes/Project.class.php';

$Project = new Project();
echo $Project->getStatusProject();

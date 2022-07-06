<?php   
    //import config database
    $configDatabase = require __DIR__ . "./config.php";

    //Connect database
    $_ConnectInDatabase = mysqli_connect($configDatabase['HostDatabase'] ,$configDatabase['UserNameInDatabase'], $configDatabase['PasswordUserInDatabase'], $configDatabase['NameDatabase']);
?>
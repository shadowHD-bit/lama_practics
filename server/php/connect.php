<?php   
    //import config database
    $configDatabase = require('/OpenServer/domains/lamapractics/server/php/config.php');

    //Connect database
    $_ConnectInDatabase = mysqli_connect($configDatabase['HostDatabase'] ,$configDatabase['UserNameInDatabase'], $configDatabase['PasswordUserInDatabase'], $configDatabase['NameDatabase']);
?>
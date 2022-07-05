<?php   
    //import config database
    $configDatabase = include('./config.php');

    //Connect database
    $_ConnectInDatabase = mysqli_connect($configDatabase['HostDatabase'] ,$configDatabase['UserNameInDatabase'], $configDatabase['PasswordUserInDatabase'], $configDatabase['NameDatabase']);
?>
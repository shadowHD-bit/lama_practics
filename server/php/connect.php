<?php   
    //import config database
    $configDatabase = __DIR__ .'./config.php';

    //Connect database
    $_ConnectInDatabase = mysqli_connect($configDatabase['HostDatabase'] ,$configDatabase['UserNameInDatabase'], $configDatabase['PasswordUserInDatabase'], $configDatabase['NameDatabase']);
?>
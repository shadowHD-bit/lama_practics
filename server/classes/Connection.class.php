<?php
//Init class Connection

class Connection
{
    //Function connect to database
    function getDatabaseConnect()
    {
        $data_connection = require(__DIR__ . '/../configs/configDatabase.php');
        $connection = mysqli_connect($data_connection['HostDatabase'], $data_connection['UserNameInDatabase'], $data_connection['PasswordUserInDatabase'], $data_connection['NameDatabase']) or die("Error to connect in database... Please, say your administrator site!");
        return $connection;
    }
}

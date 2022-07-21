<?php
require_once realpath(dirname(__FILE__) . './Connection.class.php');

//Init class auth
class Admin
{
    //Show user method in admin panel method
    function showUser()
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $get_users_not_auth_user = $mysql_connect_for_query->query("SELECT * FROM `$userTable` WHERE `$userTable`.isAdmin = 0");
        //Get result in right format
        $users = mysqli_fetch_all($get_users_not_auth_user, MYSQLI_ASSOC);
        //Display data
        return json_encode($users);
    }

    //Add new user in admin panel method
    function addNewUser($name, $lastname, $secondname, $tel, $mail, $date, $login, $pass)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $mysql_connect_for_query->query("INSERT INTO `$userTable` (login, first_name, last_name, second_name, email, phone_number, date_birthday, password) 
                                        VALUES ('$login', '$name', '$lastname', '$secondname', '$mail', '$tel', '$date', '$pass')");
    }

    //Delete user in admin panel method
    function deleteUser($id_user)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        $userProjectTable = $tables_database['UserProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $mysql_connect_for_query->query("DELETE FROM `$userProjectTable` WHERE `$userProjectTable`.id_user = '$id_user'");
        $mysql_connect_for_query->query("DELETE FROM `$userTable` WHERE `$userTable`.id_user = '$id_user'");
    }
}

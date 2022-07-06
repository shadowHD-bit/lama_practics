<?php

//Import connection SQL Server
require('../connect.php');

//Import metadata database table
$configTableDatabase = require('../configTableDatabase.php');

//Import metadata database
$config = require('../config.php');

//Get data on client part
$_loginUserInForm = $_POST['loginFetch'];
$_passwordUserInForm = $_POST['passwordFetch'];

//Get name user table
$userTable = $configTableDatabase['UserTable'];

//Connect data user in SQL Server
$mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
$resultAuthUser = $mysqlConnectForQuery->query("SELECT * FROM `$userTable` WHERE `login`='$_loginUserInForm' AND `password`= '$_passwordUserInForm'");
$userInDatabase = $resultAuthUser->fetch_assoc();
if (count($userInDatabase) == 0) {
    $message = 'Неверный логин или пароль!';
    echo $message;
} else {
    //Set COOKIE for save data this user
    setcookie('user_id', $user['id_user'], time() + 220 * 8, "/");
    $mysqlConnectForQuery->close();

    //Redirect in Main page
    $_urlMainPage = '../../../client/page/MainPage/MainPage.html';
    header('Location: ' . $_urlMainPage);
}

?>

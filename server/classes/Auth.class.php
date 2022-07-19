<?php
require_once realpath(dirname(__FILE__) . './Connection.class.php');

//Init class auth
class Auth
{
    private $login_user;
    private $password_user;


    //Setter Login
    function setLogin($login_user)
    {
        $this->login_user = $login_user;
    }


    //Getter password
    function setPassword($password_user)
    {
        $this->password_user = $password_user;
    }


    //Getter login
    function getLogin()
    {
        return $this->login_user;
    }


    //Getter password
    function getPassword()
    {
        return $this->password_user;
    }


    //Auth method
    function authenticationUser()
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Data user
        $login_for_query = $this->login_user;
        $pass_for_query = $this->password_user;
        //Query auth
        $result_auth_user = $mysql_connect_for_query->query("SELECT * FROM `$userTable` WHERE login='$login_for_query' AND password= '$pass_for_query'");
        //For cookie
        $data_user = $result_auth_user->fetch_assoc();
        //Check user in database
        if ($result_auth_user->num_rows == 0) {
            //HTTP code
            http_response_code(200);
            //Display error
            return json_encode([
                'error' => true,
                'message' => 'User not found!',
            ]);
        } else {
            //HTTP code
            http_response_code(200);
            //Set COOKIE for save data this user
            setcookie('user_id', $data_user['id_user'], time() + 220 * 8, "/");
            //Display ok status
            return json_encode([
                'error' => false,
                'message' => 'Access'
            ]);
        }
    }


    //Check Auth method
    function checkAuthentication()
    {
        if (!$_COOKIE['user_id']) {
            return json_encode([
                'access' => false,
            ]);
        } else {
            return json_encode([
                'access' => true,
            ]);
        }
    }


    //Logout method
    function logoutUser()
    {
        return setcookie("user_id", null, -1, '/');
    }
}

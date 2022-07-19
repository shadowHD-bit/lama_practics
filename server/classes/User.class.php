<?php
require_once realpath(dirname(__FILE__) . './Connection.class.php');

//Init class user
class User
{

    private $id_user;


    //Getter user id
    function getUserID()
    {
        return $this->id_user;
    }


    //Setter user id
    function setUserID($id_user)
    {
        return $this->id_user = $id_user;
    }


    //Get one user data method
    function getDataOneUser($id_user)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $get_user = $mysql_connect_for_query->query("SELECT * FROM `$userTable` WHERE id_user = $id_user");
        //Get result in right format
        $user = $get_user->fetch_assoc();
        //Display data
        return json_encode($user);
    }


    //Get this auth user id method
    function getCookieIdUser()
    {
        return $_COOKIE['user_id'];
    }


    //Update data user method (updated number phone)
    function updateNumberPhone($new_number)
    {
        //Get id this user
        $this_user_id = $_COOKIE['user_id'];
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $mysql_connect_for_query->query("UPDATE `$userTable` SET phone_number = '$new_number' WHERE id_user = $this_user_id");
    }


    //Update data user method (updated mail)
    function updateMail($new_mail)
    {
        //Get id this user
        $this_user_id = $_COOKIE['user_id'];
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $mysql_connect_for_query->query("UPDATE `$userTable` SET email = '$new_mail' WHERE id_user = $this_user_id");
    }


    //Change avatar user method
    function updateAvatar($files)
    {
        //Get id this user
        $this_user_id = $_COOKIE['user_id'];
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();

        //updated body
        //check if image sent
        if (isset($files)) {

            //selected image name into database
            $sql1 = "SELECT photo FROM `$userTable` WHERE id_user = '$this_user_id'";
            $prev_photo_sql = mysqli_query($mysql_connect_for_query, $sql1);
            $prev_photo = $prev_photo_sql->fetch_assoc();

            //getting image data and store them in var
            $img_name = $files['name'];
            $img_size = $files['size'];
            $tmp_name = $files['tmp_name'];
            $error    = $files['error'];

            //if there is not error occurred while uploading
            if ($img_size > 1000000) {
                # error message
                $em = "Вы пытаетесь загрузить файл большого размера!";

                //response array
                $error = array('error' => true, 'em' => $em);
                return json_encode($error);
            } else {
                //get image extension store it in var
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
                if (in_array($img_ex_lc, $allowed_exs)) {

                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;

                    //crating upload path on root directory
                    $img_upload_path = __DIR__ . "/../uploads/" . $new_img_name;

                    //move uploaded image to 'uploads' folder
                    move_uploaded_file($tmp_name, $img_upload_path);

                    //delete prev photo user
                    if ($prev_photo['photo'] != 'default.png') {
                        unlink(__DIR__ . '/../uploads/' . $prev_photo['photo']);
                    }

                    // inserting image name into database
                    $sql = "UPDATE `$userTable` SET photo ='$new_img_name' WHERE id_user = '$this_user_id'";
                    mysqli_query($mysql_connect_for_query, $sql);
                    // response array
                    $res = array('error' => false, 'src' => $new_img_name);
                    return json_encode($res);
                } else {
                    // error message
                    $em = "Вы пытаетесь загрузить файл недопустимого формата!";
                    // response array
                    $error = array('error' => true, 'em' => $em, 'img' => $files);
                    return json_encode($error);
                }
            }
        }
    }


    //Get all users (for add in project) method (not auth user)
    function getAllUsersNotAuthUser()
    {
        //Get id this user
        $this_user_id = $_COOKIE['user_id'];
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $get_users_not_auth_user = $mysql_connect_for_query->query("SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.last_name, `$userTable`.second_name, `$userTable`.photo FROM `$userTable` WHERE id_user != '$this_user_id'");
        //Get result in right format
        $users = mysqli_fetch_all($get_users_not_auth_user, MYSQLI_ASSOC);
        //Display data
        return json_encode($users);
    }


    //Get all users method
    function getAllUsers()
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $userTable = $tables_database['UserTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query
        $get_users_not_auth_user = $mysql_connect_for_query->query("SELECT * FROM `$userTable`");
        //Get result in right format
        $users = mysqli_fetch_all($get_users_not_auth_user, MYSQLI_ASSOC);
        //Display data
        return json_encode($users);
    }
}

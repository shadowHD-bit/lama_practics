<?php
require_once realpath(dirname(__FILE__) . './Connection.class.php');

//Init class task
class Task
{
    private $id_one_task;


    //Setter one task id
    function setIdOneTask($id_one_task)
    {
        return $this->id_one_task = $id_one_task;
    }


    //Getter one task id
    function getIdOneTask()
    {
        return $this->id_one_task;
    }


    //Getter all tasks
    function getAllTasks()
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        //Get other tables
        $statusTable = $tables_database['StatusTable'];

        // $taskRoleTable = $tables_database['TaskRoleTable'];
        // $userTable = $tables_database['UserTable'];
        // $roleTable = $tables_database['RoleTable'];
        // $projectTable = $tables_database['ProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get all task
        $result_get_tasks = $mysql_connect_for_query->query("SELECT * FROM `$taskTable` INNER JOIN `$statusTable` ON `$taskTable`.id_status = `$statusTable`.id_status");
        //To object data
        $tasks = mysqli_fetch_all($result_get_tasks, MYSQLI_ASSOC);
        return json_encode($tasks);
    }
}

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
        $taskRoleTable = $tables_database['TaskRoleTable'];
        $roleTable = $tables_database['RoleTable'];
        $userTable = $tables_database['UserTable'];
        $projectTable = $tables_database['ProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get all task
        $result_get_tasks = $mysql_connect_for_query->query(
            "SELECT `$taskTable`.id_task, `$taskTable`.task_name, `$projectTable`.project_name, `$taskTable`.task_deadline, `$statusTable`.status_name 
            FROM `$taskTable` 
            INNER JOIN `$statusTable` ON `$taskTable`.id_status = `$statusTable`.id_status
            INNER JOIN `$projectTable` ON `$taskTable`.id_project = `$projectTable`.id_project"
        );

        //To object data
        $tasks = mysqli_fetch_all($result_get_tasks, MYSQLI_ASSOC);

        //Query get director
        foreach ($tasks as $key => $value) {
            $this_id_task = $tasks[$key]['id_task'];
            $result_get_director_this_task = $mysql_connect_for_query->query(
                "SELECT `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name
                FROM `$userTable`
                INNER JOIN `$taskRoleTable` ON `$userTable`.id_user = `$taskRoleTable`.id_user
                INNER JOIN `$roleTable` ON `$roleTable`.id_role = `$taskRoleTable`.id_role
                INNER JOIN `$taskTable` ON `$taskTable`.id_task = `$taskRoleTable`.id_task
                WHERE `$taskTable`.id_task = $this_id_task AND `$taskRoleTable`.id_role = 3
                "
            );
            $row = mysqli_fetch_assoc($result_get_director_this_task);
            $full_name_director = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['director'] = $full_name_director;
            $tasks[$key] = $value;
        }

        //Query get executor
        foreach ($tasks as $key => $value) {
            $this_id_task = $tasks[$key]['id_task'];
            $result_get_executor_this_project = $mysql_connect_for_query->query(
                "SELECT `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name
                FROM `$userTable`
                INNER JOIN `$taskRoleTable` ON `$userTable`.id_user = `$taskRoleTable`.id_user
                INNER JOIN `$roleTable` ON `$roleTable`.id_role = `$taskRoleTable`.id_role
                INNER JOIN `$taskTable` ON `$taskTable`.id_task = `$taskRoleTable`.id_task
                WHERE `$taskTable`.id_task = $this_id_task AND `$taskRoleTable`.id_role = 1
                "
            );
            $row = mysqli_fetch_assoc($result_get_executor_this_project);
            $full_name_executor = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['executor'] = $full_name_executor;
            $tasks[$key] = $value;
        }

        return json_encode($tasks);
    }
}

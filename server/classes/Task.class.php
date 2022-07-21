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

    function getOneTask($task_id)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        //Get other tables
        $statusTable = $tables_database['StatusTable'];
        $userTable = $tables_database['UserTable'];
        $taskRoleTable = $tables_database['TaskRoleTable'];
        $checklistTable = $tables_database['ChecklistTable'];

        $taskDirector = 2;
        $taskPerformer = 1;

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();

        //Query get task
        $task_data = $mysql_connect_for_query->query("SELECT * FROM `$taskTable`
                                            INNER JOIN `$statusTable` ON `$statusTable`.id_status = `$taskTable`.id_status
                                            WHERE id_task = '$task_id'");
        //To object data
        $result_get_task = mysqli_fetch_all($task_data, MYSQLI_ASSOC);


        //Query get director
        foreach ($result_get_task as $key => $value) {
            $result_get_director_this_task = $mysql_connect_for_query->query(
                "SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name, `$userTable`.photo
                FROM `$userTable`
                INNER JOIN `$taskRoleTable` ON `$userTable`.id_user = `$taskRoleTable`.id_user
                INNER JOIN `$taskTable` ON `$taskTable`.id_task = `$taskTable`.id_task
                WHERE `$taskTable`.id_task = $task_id AND `$taskRoleTable`.id_role = $taskDirector
                "
            );
            $row = mysqli_fetch_assoc($result_get_director_this_task);
            $full_name_director = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['director'] = [
                'full_name' => $full_name_director,
                'avatar' => $row['photo'],
            ];
            $result_get_task[$key] = $value;
        }

        //Query get performer
        foreach ($result_get_task as $key => $value) {
            $result_get_performer_this_task = $mysql_connect_for_query->query(
                "SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name, `$userTable`.photo
                FROM `$userTable`
                INNER JOIN `$taskRoleTable` ON `$userTable`.id_user = `$taskRoleTable`.id_user
                INNER JOIN `$taskTable` ON `$taskTable`.id_task = `$taskTable`.id_task
                WHERE `$taskTable`.id_task = $task_id AND `$taskRoleTable`.id_role = $taskPerformer
                "
            );
            $row = mysqli_fetch_assoc($result_get_performer_this_task);
            $full_name_performer = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['performer'] = [
                'full_name' => $full_name_performer,
                'avatar' => $row['photo'],
            ];
            $result_get_task[$key] = $value;
        }

        //Query get checklist
        foreach ($result_get_task as $key => $value) {
            $result_get_checklist_this_task = $mysql_connect_for_query->query(
                "SELECT * FROM `$checklistTable`
                        WHERE id_task = '$task_id'"
            );
            $row_checklist = mysqli_fetch_all($result_get_checklist_this_task, MYSQLI_ASSOC);

            $value['checklist'] = $row_checklist;
            $result_get_task[$key] = $value;
        }

        //Query get subtasks
        foreach ($result_get_task as $key => $value) {
            $result_get_subtasks_this_task = $mysql_connect_for_query->query(
                "SELECT * FROM `$taskTable`
                                INNER JOIN `$statusTable` ON `$statusTable`.id_status = `$taskTable`.id_status
                                WHERE id_uppertask = '$task_id'"
            );
            $row = mysqli_fetch_all($result_get_subtasks_this_task, MYSQLI_ASSOC);
            $value['subtasks'] = $row;
            $result_get_task[$key] = $value;
        }

        return json_encode($result_get_task);
    }

    function createChecklistItem($task_id, $checklistPointValue) {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        $checklistTable = $tables_database['ChecklistTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get one project
        $set_checklist = $mysql_connect_for_query->query(
            "INSERT INTO `$checklistTable` (id_task, point_name) VALUES ('$task_id', '$checklistPointValue')"
        );

            $result_get_checklist_this_task = $mysql_connect_for_query->query(
                "SELECT * FROM `$checklistTable`
                        WHERE id_task = '$task_id'"
            );
            $row_checklist = mysqli_fetch_all($result_get_checklist_this_task, MYSQLI_ASSOC);
            return json_encode($row_checklist);
        }

    function deleteChecklistPoint($id_point) {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $checklistTable = $tables_database['ChecklistTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get one project
        $mysql_connect_for_query->query(
            "DELETE FROM `$checklistTable` WHERE `$checklistTable`.id_point = $id_point "
        );

    }

    function updateChecklistItem($id_point, $checkbox_status) {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $checklistTable = $tables_database['ChecklistTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get one project
        $mysql_connect_for_query->query(
            "UPDATE `$checklistTable` SET isChecked = '$checkbox_status' WHERE id_point = $id_point"
        );

    }


}

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
        //Get auth user id
        $auth_user_id = $_COOKIE['user_id'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get all task
        $result_get_tasks = $mysql_connect_for_query->query(
            "SELECT `$taskTable`.id_task, `$taskTable`.task_name, `$projectTable`.id_project, `$projectTable`.project_name, `$taskTable`.task_deadline, `$statusTable`.status_name 
            FROM `$taskTable` 
            INNER JOIN `$statusTable` ON `$taskTable`.id_status = `$statusTable`.id_status
            LEFT JOIN `$projectTable` ON `$taskTable`.id_project = `$projectTable`.id_project
            INNER JOIN `$taskRoleTable` ON `$taskTable`.id_task = `$taskRoleTable`.id_task
            WHERE `$taskRoleTable`.id_user = '$auth_user_id'
            "
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
                WHERE `$taskTable`.id_task = $this_id_task AND `$roleTable`.role_name = 'Постановщик'
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
                WHERE `$taskTable`.id_task = $this_id_task AND `$roleTable`.role_name = 'Ответственный'
                "
            );
            $row = mysqli_fetch_assoc($result_get_executor_this_project);
            $full_name_executor = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['executor'] = $full_name_executor;
            $tasks[$key] = $value;
        }
        return json_encode($tasks);
    }

    //Get data one task method
    function getOneTask($task_id)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        $roleTable = $tables_database['RoleTable'];
        //Get other tables
        $statusTable = $tables_database['StatusTable'];
        $userTable = $tables_database['UserTable'];
        $taskRoleTable = $tables_database['TaskRoleTable'];
        $checklistTable = $tables_database['ChecklistTable'];
        $projectTable = $tables_database['ProjectTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get task
        $task_data = $mysql_connect_for_query->query("SELECT * FROM `$taskTable`
                                            INNER JOIN `$statusTable` ON `$statusTable`.id_status = `$taskTable`.id_status
                                            LEFT JOIN `$projectTable` ON `$projectTable`.id_project = `$taskTable`.id_project
                                            WHERE id_task = '$task_id'");
        //To object data
        $result_get_task = mysqli_fetch_all($task_data, MYSQLI_ASSOC);
        //Query get director
        foreach ($result_get_task as $key => $value) {
            $result_get_director_this_task = $mysql_connect_for_query->query(
                "SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name, `$userTable`.photo
                FROM `$userTable`
                INNER JOIN `$taskRoleTable` ON `$userTable`.id_user = `$taskRoleTable`.id_user
                INNER JOIN `$taskTable` ON `$taskTable`.id_task = `$taskRoleTable`.id_task
                INNER JOIN `$roleTable` ON `$roleTable`.id_role =  `$taskRoleTable`.id_role
                WHERE `$taskTable`.id_task = $task_id AND `$roleTable`.role_name = 'Постановщик'
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
                INNER JOIN `$taskTable` ON `$taskTable`.id_task = `$taskRoleTable`.id_task
                INNER JOIN `$roleTable` ON `$roleTable`.id_role =  `$taskRoleTable`.id_role
                WHERE `$taskTable`.id_task = $task_id AND `$roleTable`.role_name = 'Ответственный'
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

    //Create check item 
    function createChecklistItem($task_id, $checklistPointValue)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
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

    //Delete checkpoint method
    function deleteChecklistPoint($id_point)
    {
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

    //Get creator task method
    function getCreatorTaskByIdTask($id_task)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        //Get other tables
        $taskRoleTable = $tables_database['TaskRoleTable'];
        $roleTable = $tables_database['RoleTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get creator
        $result_get_creator_this_project = $mysql_connect_for_query->query(
            "SELECT `$taskRoleTable`.id_user
            FROM `$taskRoleTable`
            INNER JOIN `$roleTable` ON `$roleTable`.id_role = `$taskRoleTable`.id_role
            WHERE `$taskRoleTable`.id_task = $id_task AND `$roleTable`.role_name = 'Постановщик'
            "
        );
        $row = mysqli_fetch_assoc($result_get_creator_this_project);
        return $row['id_user'];
    }

    //Change status task method
    function changeStatusTask($id_status, $id_task)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query(
            "UPDATE `$taskTable` SET `$taskTable`.id_status = $id_status
            WHERE `$taskTable`.id_task = $id_task
            "
        );
    }

    //Create task method
    function createTask($title, $descr, $deadline, $invite, $proj, $creator)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        //Get other tables
        $taskRoleTable = $tables_database['TaskRoleTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get one task
        if ($proj == 'null') {
            $mysql_connect_for_query->query(
                "INSERT INTO `$taskTable` (id_status, task_name, task_deadline, task_description) 
                VALUES (1, '$title', '$deadline', '$descr')"
            );
        } else {
            $mysql_connect_for_query->query(
                "INSERT INTO `$taskTable` (id_project, id_status, task_name, task_deadline, task_description) 
                VALUES ('$proj', 1, '$title', '$deadline', '$descr')"
            );
        }
        //Get id inserted task
        $id_inserted_task = $mysql_connect_for_query->query("SELECT `$taskTable`.id_task FROM `$taskTable` WHERE `$taskTable`.task_name = '$title'");
        //Get result in right format
        $id_task_from_database = mysqli_fetch_assoc($id_inserted_task);
        $task_ID = $id_task_from_database['id_task'];
        //inserted members
        $mysql_connect_for_query->query("INSERT INTO `$taskRoleTable` (id_task, id_user, id_role) VALUES ('$task_ID', '$invite', 2)");

        //Creator project
        $mysql_connect_for_query->query("INSERT INTO `$taskRoleTable` (id_task, id_user, id_role) VALUES ('$task_ID', '$creator', 1)");
    }

    //Update checklist method
    function updateChecklistItem($id_point, $checkbox_status)
    {
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

    //Delete task method
    function deleteTask($id_task)
    {
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        //Get other tables
        $taskRoleTable = $tables_database['TaskRoleTable'];
        $checklistTable = $tables_database['ChecklistTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query("DELETE FROM `$taskRoleTable`
                                        WHERE `$taskRoleTable`.id_task = '$id_task'");
        $mysql_connect_for_query->query("DELETE FROM `$checklistTable`
                                         WHERE `$checklistTable`.id_task = '$id_task'");
        $mysql_connect_for_query->query("DELETE FROM `$taskTable`
                                        WHERE `$taskTable`.id_task = '$id_task'");
        $mysql_connect_for_query->query("DELETE FROM `$taskTable`
                                        WHERE `$taskTable`.id_uppertask = '$id_task'");
    }


    //Delegate method
    function delegate($id_user, $id_task)
    {
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        //Get other tables
        $taskRoleTable = $tables_database['TaskRoleTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query("UPDATE `$taskRoleTable` 
                                        SET `$taskRoleTable`.id_user = '$id_user'
                                        WHERE `$taskRoleTable`.id_task = '$id_task' AND `$taskRoleTable`.id_role = 2");
    }

    //Create upper task method
    function createUpperTask($task_main, $title, $descr, $deadline, $invite, $creator)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];
        //Get other tables
        $taskRoleTable = $tables_database['TaskRoleTable'];
        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();

        $get_proj_task = $mysql_connect_for_query->query("SELECT `$taskTable`.id_project FROM `$taskTable` WHERE `$taskTable`.id_task = '$task_main'");
        $id_proj_task_from_database = mysqli_fetch_assoc($get_proj_task);
        $project_ID = $id_proj_task_from_database['id_project'];
        //Query get one task
        if ($project_ID == 'null') {
            $mysql_connect_for_query->query(
                "INSERT INTO `$taskTable` (id_uppertask, id_status, task_name, task_deadline, task_description) 
                VALUES ('$task_main', 1, '$title', '$deadline', '$descr')"
            );
        } else {
            $mysql_connect_for_query->query(
                "INSERT INTO `$taskTable` (id_uppertask, id_project, id_status, task_name, task_deadline, task_description) 
                VALUES ('$task_main', '$project_ID', 1, '$title', '$deadline', '$descr')"
            );
        }

        //Get id inserted task
        $id_inserted_task = $mysql_connect_for_query->query("SELECT `$taskTable`.id_task FROM `$taskTable` WHERE `$taskTable`.task_name = '$title'");
        //Get result in right format
        $id_task_from_database = mysqli_fetch_assoc($id_inserted_task);
        $task_ID = $id_task_from_database['id_task'];
        //inserted members
        $mysql_connect_for_query->query("INSERT INTO `$taskRoleTable` (id_task, id_user, id_role) VALUES ('$task_ID', '$invite', 2)");
        //Creator project
        $mysql_connect_for_query->query("INSERT INTO `$taskRoleTable` (id_task, id_user, id_role) VALUES ('$task_ID', '$creator', 1)");
    }

    //Update task method
    function updateDataTask($_id_Task, $_titleTask, $_descriptionTask, $_dateTask)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $taskTable = $tables_database['TaskTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query("UPDATE `$taskTable` SET `$taskTable`.task_name = '$_titleTask',
                                                                    `$taskTable`.task_deadline = '$_dateTask',
                                                                    `$taskTable`.task_description = '$_descriptionTask'
                                        WHERE `$taskTable`.id_task = '$_id_Task'
        ");
    }
}

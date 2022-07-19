<?php
require_once realpath(dirname(__FILE__) . './Connection.class.php');

//Init class auth
class Project
{

    //Get all project method
    function getAllProject()
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $statusTable = $tables_database['StatusTable'];
        $userTable = $tables_database['UserTable'];
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];

        //Get auth user id
        $auth_user_id = $_COOKIE['user_id'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get all project
        $result_get_projects = $mysql_connect_for_query->query(
            "SELECT `$projectTable`.id_project, `$projectTable`.project_name, `$projectTable`.project_deadline, `$projectTable`.project_description, `$statusTable`.status_name 
            FROM `$projectTable` 
            INNER JOIN `$statusTable` ON `$projectTable`.id_status = `$statusTable`.id_status
            INNER JOIN `$userProjectTable` ON `$userProjectTable`.id_project = `$projectTable`.id_project
            INNER JOIN `$userTable` ON `$userTable`.id_user = `$userProjectTable`.id_user
            WHERE `$userTable`.id_user = $auth_user_id"
        );

        //To object data
        $projects = mysqli_fetch_all($result_get_projects, MYSQLI_ASSOC);

        //Query get creator
        foreach ($projects as $key => $value) {
            $this_id_project = $projects[$key]['id_project'];
            $result_get_creator_this_project = $mysql_connect_for_query->query(
                "SELECT `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name
                FROM `$userTable`
                INNER JOIN `$userProjectTable` ON `$userTable`.id_user = `$userProjectTable`.id_user
                INNER JOIN `$projectTable` ON `$userProjectTable`.id_project = `$projectTable`.id_project
                WHERE `$projectTable`.id_project = $this_id_project AND `$userProjectTable`.isCreator = 1
                "
            );
            $row = mysqli_fetch_assoc($result_get_creator_this_project);
            $full_name_creator = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['creator'] = $full_name_creator;
            $projects[$key] = $value;
        }

        return json_encode($projects);
    }

    //get one project data method
    function getOneProject($id_project)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $statusTable = $tables_database['StatusTable'];
        $userTable = $tables_database['UserTable'];
        $userProjectTable = $tables_database['UserProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get one project
        $project_data = $mysql_connect_for_query->query(
            "SELECT `$statusTable`.status_name, `$projectTable`.id_project, `$projectTable`.project_name, `$projectTable`.project_start, `$projectTable`.project_deadline, `$projectTable`.project_description FROM `$projectTable`
            INNER JOIN `$statusTable` ON `$statusTable`.id_status = `$projectTable`.id_status
            WHERE id_project = $id_project
            "
        );

        //Get result in right format
        $result_get_project = mysqli_fetch_all($project_data, MYSQLI_ASSOC);

        //Query get creator
        foreach ($result_get_project as $key => $value) {
            $result_get_creator_this_project = $mysql_connect_for_query->query(
                "SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.second_name, `$userTable`.last_name, `$userTable`.photo
                FROM `$userTable`
                INNER JOIN `$userProjectTable` ON `$userTable`.id_user = `$userProjectTable`.id_user
                INNER JOIN `$projectTable` ON `$userProjectTable`.id_project = `$projectTable`.id_project
                WHERE `$projectTable`.id_project = $id_project AND `$userProjectTable`.isCreator = 1
                "
            );
            $row = mysqli_fetch_assoc($result_get_creator_this_project);
            $full_name_creator = $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'];
            $value['creator'] = [
                'full_name' => $full_name_creator,
                'avatar' => $row['photo'],
            ];
            $result_get_project[$key] = $value;
        }

        //Query get members
        foreach ($result_get_project as $key => $value) {
            $result_get_members_this_project = $mysql_connect_for_query->query(
                "SELECT `$userTable`.first_name, `$userTable`.last_name, `$userTable`.second_name, `$userTable`.photo FROM `$userProjectTable`
                INNER JOIN `$userTable` ON `$userTable`.id_user = `$userProjectTable`.id_user
                WHERE id_project = $id_project AND isCreator = 0
                "
            );
            $row_members = mysqli_fetch_all($result_get_members_this_project, MYSQLI_ASSOC);

            foreach ($row_members as $key_members => $row) {
                $members_array[$key_members] = [
                    'full_name' => $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['second_name'],
                    'avatar' => $row['photo']
                ];
            }
            $value['members'] = $members_array;
            $result_get_project[$key] = $value;
        }
        //Display error
        return json_encode($result_get_project);
    }


    //Create project class
    function createProject($name_project, $description_project, $date_start_project, $date_deadline_project, $id_creator, $members_project)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get one project
        $mysql_connect_for_query->query(
            "INSERT INTO `$projectTable` (id_status, project_start, project_deadline, project_description, project_name) VALUES (1, '$date_start_project', '$date_deadline_project', '$description_project','$name_project')"
        );
        //Get id inserted project
        $id_inserted_project = $mysql_connect_for_query->query("SELECT `$projectTable`.id_project FROM `$projectTable` WHERE `$projectTable`.project_name = '$name_project'");
        //Get result in right format
        $id_project_from_database = mysqli_fetch_assoc($id_inserted_project);
        $project_ID = $id_project_from_database['id_project'];
        //inserted members
        foreach ($members_project as $userID) {
            $mysql_connect_for_query->query("INSERT INTO `$userProjectTable` (id_user, id_project, isCreator) VALUES ('$userID', '$project_ID', 0)");
        }
        //Creator project
        $mysql_connect_for_query->query("INSERT INTO `$userProjectTable` (id_user, id_project, isCreator) VALUES ('$id_creator', '$project_ID', 1)");
    }

    function getCreatorProjectByIdProject($id_project)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        //Query get creator
        $result_get_creator_this_project = $mysql_connect_for_query->query(
            "SELECT `$userProjectTable`.id_user
            FROM `$userProjectTable`
            INNER JOIN `$projectTable` ON `$userProjectTable`.id_project = `$projectTable`.id_project
            WHERE `$projectTable`.id_project = $id_project AND `$userProjectTable`.isCreator = 1
            "
        );
        $row = mysqli_fetch_assoc($result_get_creator_this_project);
        return $row['id_user'];
    }

    //change status project method
    function changeStatusProject($id_project, $id_status)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query(
            "UPDATE `$projectTable` SET `$projectTable`.id_status = $id_status
            WHERE `$projectTable`.id_project = $id_project
            "
        );
    }

    //change status project method
    function getStatusProject()
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $statusTable = $tables_database['StatusTable'];
        $projectTable = $tables_database['ProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $status_all = $mysql_connect_for_query->query("SELECT * FROM `$statusTable`");

        $status = mysqli_fetch_all($status_all, MYSQLI_ASSOC);
        return json_encode($status);
    }

    function updateDataProject($id_project, $new_title, $new_descr, $new_date, $new_start)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query("UPDATE `$projectTable` SET `$projectTable`.project_start = '$new_start',
                                                                    `$projectTable`.project_deadline = '$new_date',
                                                                    `$projectTable`.project_description = '$new_descr',
                                                                    `$projectTable`.project_name = '$new_title'
                                        WHERE `$projectTable`.id_project = '$id_project'
        ");
    }

    function getNotAddedUser($project_ID)
    {
        //Get User table
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];
        $userTable = $tables_database['UserTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $players = $mysql_connect_for_query->query("SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.last_name, `$userTable`.second_name, `$userTable`.photo
                                                    FROM `$userTable`
                                                    WHERE `$userTable`.id_user NOT IN (SELECT `$userProjectTable`.id_user 
                                                                                FROM `$userProjectTable`
                                                                                WHERE `$userProjectTable`.id_project = '$project_ID')");

        $players_right = mysqli_fetch_all($players, MYSQLI_ASSOC);
        return json_encode($players_right);
    }

    function getUserInThisProject($project_ID)
    {
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];
        $userTable = $tables_database['UserTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $player = $mysql_connect_for_query->query("SELECT `$userTable`.id_user, `$userTable`.first_name, `$userTable`.last_name, `$userTable`.second_name, `$userTable`.photo
                                                    FROM  `$userTable`
                                                    INNER JOIN `$userProjectTable` ON `$userProjectTable`.id_user = `$userTable`.id_user
                                                    WHERE `$userProjectTable`.isCreator = 0 AND `$userProjectTable`.id_project = '$project_ID'
        ");

        $players_right = mysqli_fetch_all($player, MYSQLI_ASSOC);
        return json_encode($players_right);
    }

    function addedUserInProject($id_project, $id_user)
    {
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];
        $userTable = $tables_database['UserTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query("INSERT INTO `$userProjectTable` (id_user, id_project, isCreator)
                                        VALUES ($id_user, $id_project, 0)
        ");
    }

    function deleteUserInProject($id_project, $id_user){
        $tables_database = require(__DIR__ . '/../configs/configTableDataBase.php');
        $projectTable = $tables_database['ProjectTable'];
        $userProjectTable = $tables_database['UserProjectTable'];
        $userTable = $tables_database['UserTable'];

        //Get connect
        $database_connect = new Connection();
        $mysql_connect_for_query = $database_connect->getDatabaseConnect();
        $mysql_connect_for_query->query("DELETE FROM `$userProjectTable`
                                        WHERE `$userProjectTable`.id_user = '$id_user' AND `$userProjectTable`.id_project = '$id_project'");
    }
}

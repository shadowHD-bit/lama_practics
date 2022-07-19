<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="MainPage.css?v1">


    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
    <section class="main_page">
        <div class="Menu">
            <div class="profile_wrapper">
                <a href="../ProfilePage/ProfilePage.php">
                    <div class="Button_profile" id="photo_navs">
                    </div>
                </a>

                <!-- BIO user -->
                <a id="bio_user" class="profile_name" href="../ProfilePage/ProfilePage.php">
                    <span class="menu_fullname_placeholder"></span>
                    <span class="menu_fullname_placeholder"></span>
                    <span class="menu_fullname_placeholder"></span>
                </a>
            </div>
            <div class="menu_btn_wrapper">

                <a href="../MainPage/MainPage.php" class="button_menu_text" id="Tasks"> Задачи</a>
                <a href="../ProjectPage/ProjectPage.php" class="button_menu_text" id="Projects">Проекты</a>
                <button class="Exit" id="logout">
                    Выход
                </button>
            </div>
        </div>
        <div class="main_content">
            <div class="tasks_page">
                <div class="header_content_task">
                    <a id="Task_list"> Список задач </a>
                </div>
                <div class="table_task">
                    <table>
                        <thead id="task_head">

                        </thead>
                        <tbody id="task_user">
                            <!-- This display task -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- Get task script -->
    <script type="module" src="../../scripts/ajax/get/get.data.task.js"></script>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
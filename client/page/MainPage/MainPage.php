<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="MainPage.css?v1">
    <? require('../../assets/libraries/head.lib.php') ?>

    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
    <section class="main_page">
        <div class="Menu">
            <div class="profile_wrapper">
                <div class="Button_profile" id="photo_navs"></div>
                <!-- BIO user -->
                <a id="bio_user" class="profile_name"></a>
            </div>
            <div class="menu_btn_wrapper">
                <a href="../ProfilePage/ProfilePage.php" class="button_menu_text" id="Profile">Профиль</a>
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
<!--                            <tr>-->
<!--                                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">-->
<!--                                    <span class="title">-->
<!--                                        Название-->
<!--                                    </span>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <span class="poster">-->
<!--                                        Постановщик-->
<!--                                    </span>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <span class="mainer">-->
<!--                                        Ответственный-->
<!--                                    </span>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <span class="project">-->
<!--                                        Проект-->
<!--                                    </span>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <span class="date">-->
<!--                                        Сроки-->
<!--                                    </span>-->
<!--                                </td>-->
<!--                                <td style="border-bottom-right-radius: 10px; border-top-right-radius: 10px">-->
<!--                                    <span class="status">-->
<!--                                        Статус-->
<!--                                    </span>-->
<!--                                </td>-->
<!--                            </tr>-->
                        </thead>
                        <tbody id="task_user">
                            <!-- This display task -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <? require('../../assets/libraries/scripts.lib.php') ?>
    <!-- Get task script -->
    <script type="module" src="../../scripts/ajax/get/get.data.task.js"></script>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
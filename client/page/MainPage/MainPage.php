<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="MainPage.css">
    <? require('../../assets/libraries/head.lib.php') ?>

    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
    <section class="main_page">

        <div class="Menu">
            <div class="profile_wrapper">
                <button class="Button_profile"></button>
                <!-- BIO user -->
                <a id="bio_user" class="profile_name"></a>
            </div>
            <div class="menu_btn_wrapper">
                <button class="button_menu_text" id="Profile">Профиль</button>
                <button class="button_menu_text" id="Tasks"> Задачи</button>
                <button class="button_menu_text" id="Projects">Проекты</button>
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
                        <thead>
                            <tr>
                                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                                    <span class="title">
                                        Название
                                    </span>
                                </td>
                                <td>
                                    <span class="poster">
                                        Постановщик
                                    </span>
                                </td>
                                <td>
                                    <span class="mainer">
                                        Ответственный
                                    </span>
                                </td>
                                <td>
                                    <span class="project">
                                        Проект
                                    </span>
                                </td>
                                <td>
                                    <span class="date">
                                        Сроки
                                    </span>
                                </td>
                                <td style="border-bottom-right-radius: 10px; border-top-right-radius: 10px">
                                    <span class="status">
                                        Статус
                                    </span>
                                </td>
                            </tr>
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
    <script src="../../scripts/ajax/get/get.data.task.js"></script>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
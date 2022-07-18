<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="TaskPage.css?v1">
    <?php require('../../assets/libraries/font_awesome.php') ?>

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
                <a id="task_list">Информация о задаче</a>
            </div>


            <div class="task_field">

                <div class="task_name">
                    <p class="task_title">Тема:</p>
                    <p class="task_info" id="title_task">
                        <span class="placeholder"></span>
                    </p>
                </div>
                <hr>
                <div class="task_deadline">
                    <p class="task_title">Сроки:</p>
                    <p class="task_info" id="deadline_task">
                        <span class="placeholder"></span>
                    </p>
                </div>
                <hr>
                <div class="task_description">
                    <p class="task_title">Описание:</p>
                    <p class="task_info" id="description_task">
                        <span class="placeholder placeholder_description"></span>
                    </p>
                </div>
                <hr>

                <div class="task_director">
                    <p class="task_title">Постановщик:</p>
                    <div class="task_member" id="director_task">
                        <span class="placeholder"></span>
                    </div>
                </div>

                <div class="task_performer">
                    <p class="task_title">Исполнитель:</p>

                    <div class="task_member" id="performer_task">
                        <span class="placeholder"></span>
                    </div>

                </div>

            </div>

            <div class="header_content_task">
                <a id="task_list">Чек-лист</a>
            </div>

            <div class="task_cheklist">
                <p class="task_title">Пункты:</p>

                <div class="checklist_item">
                    <div class="checklist_item_text">
                        <label>
                            <input type="checkbox">
                            <p class="task_info">Задача</p>
                        </label>
                    </div>
                    <button class="delete_item_btn">
                        <p> + </p>
                    </button>
                </div>

                <div class="checklist_item">
                    <button class="add_btn">
                        <p> + </p>
                    </button>
                </div>

                <div class="checklist_item">
                    <input placeholder="Введите задачу" class="input_field">
                </div>

            </div>

            <div class="header_content_task">
                <a id="task_list">Подзадачи</a>
                <a href="#"><i id="plus_icon" class="fas fa-plus-circle"></i></a>
            </div>

            <div class="task_subtasks">

            </div>


        </div>
    </div>
</section>


<!-- Get task script -->


<!-- Get user script -->
<script src="../../scripts/ajax/get/get.data.user.js"></script>
<!-- Get project script -->
<script type="module" src="../../scripts/ajax/get/get.data.this.task.js"></script>
<!-- Logout func script -->
<script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
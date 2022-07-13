<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты</title>
    <link rel="stylesheet" href="./ProjectItemPage.css?v1">

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
                <a id="task_list">Информация о проекте</a>
            </div>


            <div class="task_field">
                <div class="task_name">
                    <p class="task_title">Название проекта: </p>
                    <p class="task_info" id="title_project">
                        <span class="placeholder"></span>
                    </p>
                </div>
                <hr class="hr">
                <div class="task_deadline">
                    <p class="task_title">Дата окончания проекта:</p>
                    <p id="deadline_project" class="task_info">
                        <span class="placeholder"></span>
                    </p>
                </div>
                <hr class="hr">
                <div class="task_description">
                    <p class="task_title">Описание:</p>
                    <p id="project_description" class="task_info">
                        <span class="placeholder placeholder_description"></span>
                    </p>
                </div>
                <hr class="hr">

                <div class="task_director">
                    <p class="task_title">Создатель:</p>
                    <div id="creatorProject" class="task_member">
                        <span class="placeholder"></span>
                    </div>
                </div>

                <div class="task_performer">
                    <p class="task_title">Участники:</p>
                    <div id="ispolnitels" class="players">
                        <span class="placeholder"></span>
                        <span class="placeholder"></span>
                        <span class="placeholder"></span>
                        <span class="placeholder"></span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


<!-- Get task script -->


<!-- Get user script -->
<script src="../../scripts/ajax/get/get.data.user.js"></script>
<!-- Get project script -->
<script type="module" src="../../scripts/ajax/get/get.data.this.project.js"></script>
<!-- Logout func script -->
<script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
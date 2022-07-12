<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты</title>
    <link rel="stylesheet" href="CreateProjectPage.css?v1">
    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
    <section class="project_page">
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
        <div class="project_content">
            <div class="projects_page">
                <div class="header_content_project">
                    <a id="project_list"> Создание проекта </a>
                </div>
                <div class="create_project">
                    <div class="inner_project">
                        <div class="create_project_main">
                            <p>Тема проекта:</p>
                            <input id="title_project" class="create_project_input" type="text" placeholder="Введите тематику проекта">

                            <p>Описание проекта:</p>
                            <textarea id="description_project" class="create_project_input" placeholder="Введите описание проекта" name="" id="" rows="10" style="resize: none"></textarea>

                            <p>Сроки выполнения проекта:</p>
                            <input id="date_project" class="create_project_input" type="datetime-local">
                        </div>

                        <div class="create_project_members">
                            <p>Добавить участников:</p>
                            <div class="project_add_member_btn"></div>
                            <div class="project_invite_members" id="invite_block">
                                <!-- <div class="project_member">
                                    <div class="project_member_photo"></div>
                                    <label class="project_member_fullname">
                                        Pupkin vasiliy Ivanovich
                                        <input type="checkbox">
                                    </label>
                                </div> -->

                                
                            </div>
                        </div>
                    </div>

                    <hr>
                    <button class="create_project_confirm" id="accept_project_btn">Принять</button>
                    <button class="create_project_cancel">Отмена</button>
                </div>
            </div>
        </div>
    </section>

    <?php require('../../assets/libraries/scripts.lib.php') ?>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Create Project script -->
    <script src="../../scripts/ajax/create/create.project.js"></script>

    <!-- Get Users Scripts -->
    <script src="../../scripts/ajax/get/get.users.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
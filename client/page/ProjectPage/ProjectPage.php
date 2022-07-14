<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты</title>
    <link rel="stylesheet" href="ProjectPage.css?v1">
    <?php require('../../assets/libraries/font_awesome.php') ?>
    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
    <section class="project_page">

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
        <div class="project_content">
            <div class="projects_page">
                <div class="header_content_project">
                    <a id="project_list"> Список проектов </a>
                    <a href="./CreateProjectPage.php"><i id="plus_icon" class="fas fa-plus-circle"></i></a>

                </div>
                <div class="table_project">
                    <table>
                        <thead id="project_head">
                            
                        </thead>
                        <tbody id="project_user">
                            <!-- This display task -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php require('../../assets/libraries/scripts.lib.php') ?>
    <script type="module" src="../../scripts/ajax/get/get.data.project.js"></script>
    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

    <script src="../../scripts/ajax/create/create.project.js"></script>

</body>

</html>
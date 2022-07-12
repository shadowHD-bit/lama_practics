<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="TaskPage.css?v1">


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
                <a id="task_list">Информация о задаче</a>
            </div>



            <div class="task_field">

                <div class="task_name">
                    <p>Задача 1</p>
                </div>
                <div class="task_deadline">
                    <p>C 35 июля по 35 июня</p>
                </div>
                <div class="task_description">
                    <p>Необходимо сходить в магазин и закупить мясо к шашлыкам, после чего замариновать его в уксусе и майонезе</p>
                </div>
                <div class="task_director">
                    <p>Постановщик:</p>
                    <div class="task_member">
                        <div class="task_member_photo"></div>
                        <p class="task_member_fullname">Pupkin vasiliy Ivanovich</p>
                    </div>
                </div>
                <div class="task_performer">
                    <p>Исполнитель:</p>
                    <div class="task_member">
                        <div class="task_member_photo"></div>
                        <p class="task_member_fullname">Pupkin vasiliy Ivanovich</p>
                    </div>
                </div>
            </div>

            <p class="field_text1"> Чеклист </p>

            <div class="task_cheklist">

                <div class="block_C1">

                    <p> Задача выполнена </p>
                    <input type="checkbox" checked="Unchecked">
                    <button class="button_cencel">
                        <p class="blacktext"> X </p>
                    </button>
                </div>
                <div class="block_C2">
                    <button class="button_add">
                        <p class="blacktext"> + </p>
                    </button>
                </div>
                <div class="block_C3">
                    <input class="input_field">
                    </input>
                </div>

            </div>

            <p class="field_text2"> Подзадачи </p>

            <div class="task_subtasks">
                <button class="button_add">
                    <p class="blacktext"> + </p>
                </button>

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
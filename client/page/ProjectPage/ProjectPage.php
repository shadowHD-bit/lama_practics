<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты</title>
    <link rel="stylesheet" href="ProjectPage.css">
    <?php require('../../assets/libraries/head.lib.php')?>
</head>

<body>
    <section class="project_page">

        <div class="menu">
            <div class="profile_wrapper">
                <button class="button_profile"></button>
                <a class="profile_name">Хаблак Владимир Алексеевич</a>
            </div>
            <div class="menu_btn_wrapper">
                <button class="button_menu_text" id="Profile">Профиль</button>
                <button class="button_menu_text" id="Tasks"> Задачи</button>
                <button class="button_menu_text" id="Projects">Проекты</button>
                <button class="exit">
                    <a class="exit_text"> Выход </a>
                </button>
            </div>
        </div>
        <div class="project_content">
            <div class="projects_page">
                <div class="header_content_project">
                    <a id="project_list"> Список проектов </a>
                </div>
                <div class="table_project">
                    <table>
                        <thead>
                            <tr>
                                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                                    <span class="title">
                                        Название
                                    </span>
                                </td>
                                <td>
                                    <span class="description">
                                        Описание
                                    </span>
                                </td>
                                <td>
                                    <span class="creator">
                                        Организатор
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
                        <tbody id="project_user">
                        <!-- This display task -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php require('../../assets/libraries/scripts.lib.php')?>
    <script src="../../scripts/ajax/get/get.data.project.js"></script>

</body>
</html>
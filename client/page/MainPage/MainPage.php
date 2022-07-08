<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="MainPage.css">
    <? require('../../assets/libraries/head.lib.php') ?>
</head>

<body>
    <section class="main_page">
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
    </section>


    <? require('../../assets/libraries/scripts.lib.php') ?>
<script src="../../scripts/ajax/get/get.data.task.js"></script>
</body>

</html>
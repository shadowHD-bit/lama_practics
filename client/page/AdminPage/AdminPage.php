<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница администратора</title>
    <link rel="stylesheet" href="AdminPage.css?v1" />
    <?php require('../../assets/libraries/head.lib.php') ?>
    <?php require('../../assets/libraries/bootstrap.link.php') ?>
    <!-- Check Auth script -->
    <script src="../../scripts/ajax/check.admin.js"></script>
    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>
</head>

<body>
    <section class="main_page">
        <!-- include navbar -->
        <?php include('../../components/Bar/Bar.php'); ?>
        <div class="main_content">
            <div class="admin_page">
                <div class="admin_page_content">
                    <p class="admin_title">Работа с пользователями</p>
                    <div class="admin_work_user">
                        <p>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-address-book"></i> Список пользователей
                            </button>
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenterAdded" type="button">
                                <i class="fas fa-plus"></i> Добавить
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div id="table_users" class="table_users">
                                    <table class="table">
                                        <thead class="table-dark" id="head_table_admin_user">
                                            <!-- Tables col name -->
                                        </thead>
                                        <tbody id="body_table_admin_user">
                                            <!-- This users from js scripts -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </section>

    <!-- Modal added users -->
    <div class="modal fade bd-example-modal-xl" id="exampleModalCenterAdded" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Добавление пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Укажите имя пользователя:</p>
                    <input class="create_project_input" type="text" id="new_name">
                    <p>Укажите фамилию пользователя:</p>
                    <input class="create_project_input" type="text" id="new_last_name">
                    <p>Укажите отчество пользователя:</p>
                    <input class="create_project_input" type="text" id="new_second_name">
                    <p>Укажите номер телефона:</p>
                    <input class="create_project_input" type="tel" id="new_tel">
                    <p>Укажите почту:</p>
                    <input class="create_project_input" type="email" id="new_mail">
                    <p>Укажите дату рождения:</p>
                    <input class="create_project_input" type="datetime-local" id="new_date">
                    <hr />
                    <p>Укажите логин пользователя:</p>
                    <input class="create_project_input" type="text" id="new_login">
                    <p>Укажите пароль пользователя:</p>
                    <input class="create_project_input" type="password" id="new_pass">
                    <div id="error_message" style="margin-top: 20px;" class="error_message">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" id="added_new_admin_user" class="btn btn-success">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Get scripts on lib-->
    <?php require('../../assets/libraries/scripts.lib.php') ?>
    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>
    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>
    <!-- Get user admin script -->
    <script src="../../scripts/ajax/get/get.users.in.admin.js"></script>
</body>

</html>
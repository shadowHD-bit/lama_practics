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
                                Список пользователей
                            </button>
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenterAdded" type="button">
                                Добавить
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div id="table_users" class="table_users">
                                    <table class="table">
                                        <thead class="table-dark" id="head_table_admin_user">

                                        </thead>
                                        <tbody id="body_table_admin_user">

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


    <!-- Modal -->
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
                    <p>Укажите имя пользователя:
                        <input type="text" id="new_name">
                    </p>
                    <p>Укажите фамилию пользователя:
                        <input type="text" id="new_last_name">
                    </p>
                    <p>Укажите отчество пользователя:
                        <input type="text" id="new_second_name">
                    </p>
                    <p>Укажите номер телефона:
                        <input type="tel" id="new_tel">
                    </p>
                    <p>Укажите почту:
                        <input type="email" id="new_mail">
                    </p>
                    <p>Укажите дату рождения:
                        <input type="datetime-local" id="new_date">
                    </p>
                    <hr/>
                    <p>Укажите логин пользователя:
                        <input type="text" id="new_login">
                    </p>
                    <p>Укажите пароль пользователя:
                        <input type="password" id="new_pass">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" id="added_new_admin_user" class="btn btn-success" data-dismiss="modal">Добавить</button>
                </div>
            </div>
        </div>
    </div>


    <?php require('../../assets/libraries/scripts.lib.php') ?>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

    <script src="../../scripts/ajax/get/get.users.in.admin.js"></script>


</body>

</html>
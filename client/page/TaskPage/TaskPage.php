<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="TaskPage.css?v1">
    <?php require('../../assets/libraries/font_awesome.php') ?>
    <?php require('../../assets/libraries/bootstrap.link.php') ?>

    <!-- Check Auth script -->
    <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
    <section class="main_page">
        <!-- include navbar -->
        <?php include('../../components/Bar/Bar.php'); ?>
        <div class="main_content">
            <div class="tasks_page">

                <div class="header_content_task">
                    <a id="task_list">Информация о задаче</a>
                    <div id="btn_owner"></div>
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
                        <p class="task_title">Дата окончания задачи:</p>
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
                    <div class="task_status">
                        <p class="task_title">Статус:</p>
                        <div id="btn_status"></div>
                        <p class="task_info" id="status_task">
                            <span class="placeholder"></span>
                        </p>
                    </div>
                    <hr>
                    <div class="task_project">
                        <p class="task_title">Проект:</p>
                        <p class="task_info" id="project_task">
                            <span class="placeholder"></span>
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

                    <div class="checklist_points">
                        <!---->
                        <!--                    <div class="checklist_item">-->
                        <!--                        <div class="checklist_item_text">-->
                        <!--                            <label>-->
                        <!--                                <input type="checkbox">-->
                        <!--                                <p class="task_info">Задача</p>-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!--                        <button class="delete_item_btn">-->
                        <!--                            <p> + </p>-->
                        <!--                        </button>-->
                        <!--                    </div>-->

                    </div>

                    <div class="checklist_item input_checklist" style="display: none">

                    </div>

                    <div class="checklist_item">
                        <button onclick="createChecklist()" class="add_btn " id="add_checklist_item_btn">
                            <p> + </p>
                        </button>
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

    <!-- Modal -->
    <div class="modal fade bd-example-modal-xl" id="exampleModalCenterStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Изменение статуса проекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Выберите новый статус для этого проекта:</p>
                    <div id="block_change_status" class="list-group">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-xl" id="exampleModalCenterdeleteTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Вы действительно хотите удалить эту задачу?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-danger" id="delete_this_task">Да</button>
                </div>
            </div>
        </div>
    </div>


    <?php require('../../assets/libraries/scripts.lib.php') ?>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>
    <!-- Get task script -->
    <script type="module" src="../../scripts/ajax/get/get.data.this.task.js"></script>
    <!-- Add new checklist item script -->
    <script src="../../scripts/ajax/create/create.task.checklist.js"></script>
    <script src="../../scripts/ajax/update/change.status.task.js"></script>
    <script src="../../scripts/ajax/delete/delete.task.js"></script>
    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>
    <!-- Delete checklist item script -->
    <!--<script type="module" src="../../scripts/ajax/delete/delete.task.checklist.point.js"></script>-->
</body>

</html>
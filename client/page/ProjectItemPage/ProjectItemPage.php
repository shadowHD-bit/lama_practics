<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Проекты</title>
  <link rel="stylesheet" href="./ProjectItemPage.css?v1" />
  <!-- head libs import -->
  <?php require('../../assets/libraries/head.lib.php') ?>
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
          <a id="task_list">Информация о проекте</a>
          <div id="btn_owner">
          </div>
        </div>
        <div class="task_field">
          <div class="task_name">
            <p class="task_title">Название проекта:</p>
            <p class="task_info" id="title_project"></p>
          </div>
          <hr />
          <div class="task_start">
            <p class="task_title">Дата начала проекта:</p>
            <p id="start_project" class="task_info"></p>
          </div>
          <hr />
          <div class="task_deadline">
            <p class="task_title">Дата окончания проекта:</p>
            <p id="deadline_project" class="task_info"></p>
          </div>
          <hr />
          <div class="task_description">
            <p class="task_title">Описание:</p>
            <p id="project_description" class="task_info"></p>
          </div>
          <hr />
          <div class="task_status">
            <p class="task_title">Статус проекта:
            <div id="btn_status" class="btn_status">
            </div>
            </p>
            <p id="project_status" class="task_info"></p>
          </div>
          <hr />
          <div class="task_director">
            <p class="task_title">Создатель:</p>
            <div id="creatorProject" class="task_member"></div>
          </div>
          <div class="task_performer">
            <p class="task_title">Участники:
            <div id="btn_adder" class="btn_adder">
            </div>
            </p>
            <div id="ispolnitels" class="players"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade bd-example-modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Изменение данных проекта</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Тема проекта:</p>
          <input id="title_project_update" class="create_project_input" type="text" />
          <p>Описание проекта:</p>
          <textarea id="description_project_update" class="create_project_input" name="" id="" cols="100" rows="10" style="resize: none"></textarea>
          <p>Дата начала проекта:</p>
          <input id="date_project_start_update" class="create_project_input" type="datetime-local">
          <p>Дата окончания проекта:</p>
          <input id="date_project_update" class="create_project_input" type="datetime-local" />
          <div id="error_message" style="margin-top: 20px;" class="error_message">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          <button type="button" id="update_data_project_btn" class="btn btn-primary">Сохранить изменения</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade bd-example-modal-xl" id="exampleModalCenterUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Изменение участников проекта</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="players_change">
            <div class="added_players">
              <p>Выберите участника, чтобы удалить его из проекта:</p>
              <div id="already_invite" class="already_invite">
              </div>
            </div>
            <div class="change_players">
              <div class="live_search_members_project">
                <p>Выберите участника, чтобы добавить его в проект:</p>
                <input type="text" id="live_search_member_update" style="width: 90%; margin-bottom: 10px" class="form-control" placeholder="Начните вводить данные...">
              </div>
              <div class="project_invite_members" id="invite_block_update">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-primary" id="save_change_members">Сохранить изменения</button>
        </div>
      </div>
    </div>
  </div>

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
  <div class="modal fade bd-example-modal-xl" id="exampleModalCenterdelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Вы действительно хотите удалить данный проект?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
          <button type="button" class="btn btn-danger" id="delete_this_project">Да</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Get task script -->
  <?php require('../../assets/libraries/scripts.lib.php') ?>

  <!-- Get user script -->
  <script src="../../scripts/ajax/get/get.data.user.js"></script>
  <!-- Get project script -->
  <script src="../../scripts/ajax/get/get.data.this.project.js"></script>
  <!-- Logout func script -->
  <script src="../../scripts/ajax/Logout.js"></script>

  <script src="../../scripts/ajax/update/change.status.project.js"></script>
  <script src="../../scripts/ajax/update/update.data.project.js"></script>
  <script src="../../scripts/ajax/update/update.user.project.js"></script>
  <script src="../../scripts/ajax/delete/delete.project.js"></script>

</body>

</html>
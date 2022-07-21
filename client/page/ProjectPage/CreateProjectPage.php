<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Проекты</title>
  <link rel="stylesheet" href="CreateProjectPage.css?v1" />
  <?php require('../../assets/libraries/head.lib.php') ?>
  <?php require('../../assets/libraries/bootstrap.link.php') ?>


  <!-- Check Auth script -->
  <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
  <section class="project_page">
    <!-- include navbar -->
    <?php include('../../components/Bar/Bar.php'); ?>
    <div class="project_content">
      <div class="projects_page">
        <div class="header_content_project">
          <a id="project_list"> Создание проекта </a>
        </div>
        <div class="create_project">
          <div class="inner_project">
            <div class="create_project_main">
              <p>Тема проекта:</p>
              <input id="title_project" class="create_project_input" type="text" placeholder="Введите тематику проекта" />

              <p>Описание проекта:</p>
              <textarea id="description_project" class="create_project_input" placeholder="Введите описание проекта" name="" id="" rows="10" style="resize: none"></textarea>

              <p>Дата начала проекта:</p>
              <input id="date_project_start" value="<?php echo date('Y-m-d\TH:i'); ?>" class="create_project_input" type="datetime-local">

              <p>Дата окончания проекта:</p>
              <input id="date_project" class="create_project_input" type="datetime-local" />
            </div>

            <div class="create_project_members">
              <p>Добавить участников:</p>
              <div class="project_add_member_btn"></div>
              <div class="live_search_members_project">
                <input type="text" id="live_search_member" style="width: 90%; margin-bottom: 10px" class="form-control" placeholder="Начните вводить данные...">
              </div>
              <div class="project_invite_members" id="invite_block">

              </div>
            </div>
          </div>

          <hr />
          <div id="error_message" class="error_message">
            
          </div>
          <button class="create_project_confirm" id="accept_project_btn">
            Принять
          </button>
          <a href="./ProjectPage.php"><button class="create_project_cancel">Отмена</button></a>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap scripts -->
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
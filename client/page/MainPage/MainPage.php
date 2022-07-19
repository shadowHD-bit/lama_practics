<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Главная</title>
    <link rel="stylesheet" href="MainPage.css?v1" />
    <?php require('../../assets/libraries/head.lib.php') ?>

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
            <a id="Task_list"> Список задач </a>
          </div>
          <div class="table_task">
            <table>
              <thead id="task_head">
                <!-- This thead -->
              </thead>
              <tbody id="task_user">
                <!-- This display task -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <?php require('../../assets/libraries/scripts.lib.php') ?>

    <!-- Get task script -->
    <script
      type="module"
      src="../../scripts/ajax/get/get.data.task.js"
    ></script>

    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>

    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>
  </body>
</html>

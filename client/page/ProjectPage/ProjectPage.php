<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Проекты</title>
  <link rel="stylesheet" href="ProjectPage.css?v1" />
  <?php require('../../assets/libraries/head.lib.php') ?>
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
          <a id="project_list"> Список проектов </a>
          <a href="./CreateProjectPage.php"><i id="plus_icon" class="fas fa-plus-circle"></i></a>
        </div>
        <div class="filters_project">
          <!-- Filter
          <div id="filter">
            <ul>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>Фильтры</h2>
                <div class="filter_body">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sunt ut eum consectetur itaque officiis cumque totam aliquam eius perferendis. Facere dolorem id corrupti. Quasi pariatur ea perferendis dolor saepe.</p>
                </div>
              </li>
            </ul>
          </div> -->
        </div>
        <div class="table_project">
          <table>
            <thead id="project_head"></thead>
            <tbody id="project_user">
              <!-- This display task -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <script type="module" src="../../scripts/ajax/get/get.data.project.js"></script>
  <!-- Get user script -->
  <script src="../../scripts/ajax/get/get.data.user.js"></script>

  <!-- Logout func script -->
  <script src="../../scripts/ajax/Logout.js"></script>

  <script src="../../scripts/ajax/create/create.project.js"></script>
</body>

</html>
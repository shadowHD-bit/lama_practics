<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Профиль</title>
  <link rel="stylesheet" href="ProfilePage.css?v1" />
  <!-- Connect style bootstrap -->
  <?php require('../../assets/libraries/head.lib.php') ?>
  <?php require('../../assets/libraries/bootstrap.link.php') ?>
  <!-- Check Auth script -->
  <script src="../../scripts/ajax/CheckAuth.js"></script>
</head>

<body>
  <section class="profile">
    <!-- include navbar -->
    <?php include('../../components/Bar/Bar.php'); ?>
    <div class="main_content">
      <div class="profile_card">
        <div class="photo_section">
          <div id="photo_in_profile" class="photo_block"></div>
          <div class="section_btn">
            <button class="change_photo" data-toggle="modal" data-target="#exampleModalCenter">
              Изменить фото
            </button>
            <button type="button" id="change_btn" class="change_btn">Изменить данные профиля</button>
          </div>
        </div>
        <div class="bioinfo_section">
          <div class="bioinfo_title">
            <p>Личная информация</p>
          </div>
          <div class="name_user">
            <label for="user_name_input" class="user_label">Имя:</label>
            <input id="user_name_input" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="Имя" disabled />
          </div>
          <div class="last_name_user">
            <label for="user_name_input" class="user_label">Фамилия:</label>
            <input id="user_lastname_input" type="text" class="form-control" placeholder="UserLastname" aria-describedby="basic-addon2" value="Фамилия" disabled />
          </div>
          <div class="second_name_user">
            <label for="user_name_input" class="user_label">Отчество:</label>
            <input id="user_secondname_input" type="text" class="form-control" placeholder="UserSecondname" aria-describedby="basic-addon7" value="Отчество" disabled />
          </div>
          <div class="data_birthday">
            <label for="user_name_input" class="user_label">Дата рождения:</label>
            <input id="user_date_input" type="date" class="form-control" placeholder="DateUser" aria-describedby="basic-addon3" value="1978-11-11" disabled />
          </div>
        </div>
        <div class="otherinfo_section">
          <div class="name_user">
            <label for="user_name_input" class="user_label">Почта:</label>
            <input id="user_mail_input" type="email" class="form-control" placeholder="mailUser" aria-describedby="basic-addon4" value="Почта" disabled />
          </div>
          <div class="last_name_user">
            <label for="user_name_input" class="user_label">Номер телефона:</label>
            <input id="user_tel_input" type="tel" class="form-control" placeholder="telUser" aria-describedby="basic-addon5" value="+7 (800) 555 35 35" disabled />
          </div>
          <div class="second_name_user">
            <label for="user_name_input" class="user_label">Должность:</label>
            <input id="user_dol_input" type="text" class="form-control" placeholder="UserQuality" aria-describedby="basic-addon6" value="Программист" disabled />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- DragAndDrop UserPhoto -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">
            Изменить аватар профиля
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="
              display: flex;
              justify-content: center;
              align-items: center;
              flex-direction: column;
            ">
          <div id="change_error" class="change_error"></div>
          <div class="Button_profile" id="photo_in_change" style="
                width: 300px;
                height: 300px;
                margin-bottom: 50px;
                border-radius: 50%;
              "></div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupFileAddon01">Загрузка</span>
            </div>
            <div class="custom-file">
              <input onchange="previewImage(this)" id="updateAvatar" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" />
              <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Закрыть
          </button>
          <button type="button" id="savedAvatarUpdate" class="btn btn-primary">
            Сохраниить
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Get scripts from libs -->
  <?php require('../../assets/libraries/scripts.lib.php') ?>
  <!-- Get user script -->
  <script src="../../scripts/ajax/get/get.data.userprofile.js"></script>
  <script src="../../scripts/ajax/get/get.data.user.js"></script>
  <script src="../../scripts/ajax/update/update.avatar.user.js"></script>
  <!-- Logout func script -->
  <script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
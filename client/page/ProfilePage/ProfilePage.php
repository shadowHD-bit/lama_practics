<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты</title>
    <link rel="stylesheet" href="ProfilePage.css?v1">
    <?php require('../../assets/libraries/head.lib.php') ?>
</head>

<body>
    <section class="profile">
        <div class="Menu">
            <div class="profile_wrapper">
                <button class="Button_profile"></button>
                <!-- BIO user -->
                <a id="bio_user" class="profile_name"></a>
            </div>
            <div class="menu_btn_wrapper">
                <a href="../ProfilePage/ProfilePage.php" class="button_menu_text" id="Profile">Профиль</a>
                <a href="../MainPage/MainPage.php" class="button_menu_text" id="Tasks"> Задачи</a>
                <a href="../ProjectPage/ProjectPage.php" class="button_menu_text" id="Projects">Проекты</a>
                <button class="Exit" id="logout">
                    Выход
                </button>
            </div>
        </div>
        <div class="main_content">
            <div class="profile_card">
                <div class="photo_section">
                    <div class="photo_block">
                        
                    </div>
                </div>
                <div class="bioinfo_section">

                </div>
                <div class="otherinfo_section">

                </div>
            </div>
        </div>
    </section>

    <?php require('../../assets/libraries/scripts.lib.php') ?>
    <!-- Get user script -->
    <script src="../../scripts/ajax/get/get.data.user.js"></script>
    <!-- Logout func script -->
    <script src="../../scripts/ajax/Logout.js"></script>

</body>

</html>
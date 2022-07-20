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
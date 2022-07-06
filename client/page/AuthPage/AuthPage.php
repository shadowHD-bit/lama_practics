<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="./AuthPage.css">
</head>

<body>
    <div class="auth_content">
        <div class="auth_card">
            <div class="form_content">
                <div class="auth_card_content">
                    <span class="auth_name">Авторизация</span>
                    <hr class="hr_auth" />
                    <form class="form_auth" method="POST" action="../../../server/php/Auth/Auth.php">
                        <input id="login_user" name="loginFetch" placeholder="Введите логин" type="text" class="login">
                        <input id="password_user" name="passwordFetch" placeholder="Введите пароль" type="password" class="password">
                        <div class="btn_content">
                            <div class="submit_btn">
                                <button id="submit_auth" class="submit_auth" type='submit'>
                                    Войти
                                </button>
                            </div>
                            <div class="change_btn">
                                <a href="#" class="change">Забыли пароль?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="footer_card">
                    <hr />
                    <div class="footer_text_content">
                        <span>
                            <p>Для того, чтобы получить доступ к этой системе, обратитесь к администратору сайта или директору компании!</p>
                        </span>
                        <div class="icons_info">
                            <div class="icons_info_content">
                                <img src="../../assets/Auth/man.svg" />
                                <div>
                                    <span class="infos_text">Иванов Иван Иванович</span>
                                </div>
                            </div>
                            <div class="icons_info_content">
                                <img src="../../assets/Auth/phone.svg" />
                                <div>
                                    <span class="infos_text">+7 (999) 999 99 99</span>
                                </div>
                            </div>
                            <div class="icons_info_content">
                                <img src="../../assets/Auth/mail.svg" />
                                <div>
                                    <span class="infos_text">info@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="../../scripts/ajax/Auth.js"></script>
</body>

</html>
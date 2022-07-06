
//Get auth button in AuthPage.php
let authBtn = document.getElementById('submit_auth')

//Get data inputs auth form
let loginInAuthForm = document.getElementById('login_user')
let passwordInAuthForm = document.getElementById('password_user')


//Check event click on auth btn
authBtn.addEventListener('click', () => {    
    fetch("../../../../server/php/Auth/Auth.php", {
        method: "POST",
        body: {
            loginFetch: loginInAuthForm.value,
            passwordFetch: passwordInAuthForm.value
        }
    }).then(function (response) {
        console.log(response);
    }).catch(function (error) {
        console.log(error);
    });
})


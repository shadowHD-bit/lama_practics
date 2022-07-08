//Get auth button in AuthPage.php
let authBtn = document.getElementById("submit_auth");

//Get data inputs auth form
let loginInAuthForm = document.getElementById("login_user");
let passwordInAuthForm = document.getElementById("password_user");

//Get block error content in html AuthPage
let errorBlock = document.getElementById("error_content");

//Check event click on auth btn
authBtn.addEventListener("click", () => {
  let dataAuthUser = {
    loginFetch: loginInAuthForm.value,
    passwordFetch: passwordInAuthForm.value,
  };

  fetch("../../../../server/php/Auth/Auth.php", {
    method: "POST",
    body: JSON.stringify(dataAuthUser),
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      if (body.error) {
        errorBlock.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" id="error_alert" style="width: 100%" role="alert">
            <strong>Неверный логин или пароль!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        `;
      } else {
        window.location.href = "../MainPage/MainPage.php";
      }
    });
});

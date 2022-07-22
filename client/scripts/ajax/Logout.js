//Get auth button in AuthPage.php
let logoutBtn = document.getElementById("logout");

//Check event click on auth btn
logoutBtn.addEventListener("click", () => {
  fetch("../../../server/php/Auth/Logout.php", {
    method: "POST",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  }).then(function () {
    window.location.href = "../../page/AuthPage/AuthPage.php";
  });
});

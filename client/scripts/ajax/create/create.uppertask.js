let inputTitleupperTask = document.getElementById("title_uppertask");
let inputDescriptionupperTask = document.getElementById("description_uppertask");
let inputDateupperTask = document.getElementById("date_uppertask_start");
let idTask = location.search.substring(1);

let btn_upper_task = document.getElementById("uppertask_btn");

btn_upper_task.addEventListener("click", () => {
  //Post data
  let data_task = {
    titleTaskJS: inputTitleupperTask.value,
    descTaskJS: inputDescriptionupperTask.value,
    deadlineTaskJS: inputDateupperTask.value,
    thisTaskJS: idTask,
    inviteJS: document.querySelector('input[name="user_uppertask"]:checked') ? document.querySelector('input[name="user_uppertask"]:checked').value : '',
  };

  console.log(data_task);

  let error_message = document.getElementById("error_message");

  fetch("../../../../server/php/Task/CreateUpperTask.php", {
    method: "POST",
    body: JSON.stringify(data_task),
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      if (body.error) {
        error_message.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" id="error_alert" style="width: 100%" role="alert">
              <strong>Заполните все поля!</strong>
              <a type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
        `;
      } else {
        window.location.href = "../MainPage/MainPage.php";
      }
    });
});

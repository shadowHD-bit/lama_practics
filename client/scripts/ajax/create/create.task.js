let inputTitleTask = document.getElementById("title_task");
let inputDescriptionTask = document.getElementById("description_task");
let inputDateTask = document.getElementById("date_task_start");

let btn_access = document.getElementById("accept_task_btn");

btn_access.addEventListener("click", () => {
  //Post data
  let dataProject = {
    titleTaskJS: inputTitleTask.value,
    descTaskJS: inputDescriptionTask.value,
    deadlineTaskJS: inputDateTask.value,
    inviteJS: document.querySelector('input[name="user_task"]:checked') ? document.querySelector('input[name="user_task"]:checked').value : '',
    projectJS: document.querySelector('input[name="task_project"]:checked') ? document.querySelector('input[name="task_project"]:checked').value : 'null',
  };

  let error_message = document.getElementById("error_message");

  fetch("../../../../server/php/Task/CreateTask.php", {
    method: "POST",
    body: JSON.stringify(dataProject),
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

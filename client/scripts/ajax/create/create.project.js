let inputTitleProject = document.getElementById("title_project");
let inputDescriptionProject = document.getElementById("description_project");
let inputDateProject = document.getElementById("date_project");
let inputStartDate = document.getElementById("date_project_start");
let btn = document.getElementById("accept_project_btn");

btn.addEventListener("click", () => {
  //Find checkbox
  var cBox = [];
  $("input[type=checkbox]:checked").each(function () {
    cBox.push($(this).attr("value"));
  });

  cBoxNumber = cBox.map((s) => +s);

  //Post data
  let dataProject = {
    titleProjectJS: inputTitleProject.value,
    descProjectJS: inputDescriptionProject.value,
    deadlineProjectJS: inputDateProject.value,
    startDateProjectJS: inputStartDate.value,
    usersProjectJS: cBoxNumber,
  };

  let error_message = document.getElementById("error_message");

  fetch("../../../../server/php/Project/CreateProject.php", {
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
        window.location.href = "./ProjectPage.php";
      }
    });
});

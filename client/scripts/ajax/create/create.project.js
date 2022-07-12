let inputTitleProject = document.getElementById("title_project");
let inputDescriptionProject = document.getElementById("description_project");
let inputDateProject = document.getElementById("date_project");
let btn = document.getElementById("accept_project_btn");

btn.addEventListener("click", () => {
  //Find checkbox
  var cBox = [];
  $("input[type=checkbox]:checked").each(function () {
    cBox.push($(this).attr("value"));
  });

  cBoxNumber = cBox.map( s => +s )

  //Post data
  let dataProject = {
    titleProjectJS: inputTitleProject.value,
    descProjectJS: inputDescriptionProject.value,
    deadlineProjectJS: inputDateProject.value,
    usersProjectJS: cBoxNumber,
  };

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
      window.location.href = './ProjectPage.php'
    });
});

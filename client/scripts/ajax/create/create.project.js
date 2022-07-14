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
    startDateProjectJS : inputStartDate.value,
    usersProjectJS: cBoxNumber,
  };

  fetch("../../../../server/php/Project/CreateProject.php", {
    method: "POST",
    body: JSON.stringify(dataProject),
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  }).then(function () {
    window.location.href = "./ProjectPage.php";
  });
});

let idProject = location.search.substring(1);
let delete_btn = document.getElementById("delete_this_project");

delete_btn.addEventListener("click", () => {
  fetch(
    `../../../../server/php/Project/DeleteProject.php?projectid=${idProject}`,
    {
      method: "GET",
      header: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    }
  ).then(function () {
    window.location.href = "../ProjectPage/ProjectPage.php";
  });
});

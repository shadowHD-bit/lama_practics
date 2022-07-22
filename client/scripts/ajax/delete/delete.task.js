let idTask = location.search.substring(1);
let delete_btn_task = document.getElementById("delete_this_task");

delete_btn_task.addEventListener("click", () => {
  fetch(`../../../../server/php/Task/DeleteTask.php?taskid=${idTask}`, {
    method: "GET",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  }).then(function () {
    window.location.href = "../MainPage/MainPage.php";
  });
});

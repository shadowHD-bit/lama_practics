let title_input = document.getElementById("title_task_update");
let description_input = document.getElementById("description_task_update");
let date_input = document.getElementById("date_task_start_update");
let update_data_task_btn = document.getElementById("update_data_task_btn");
let idTaskFromURLThis = location.search.substring(1);

function mysqlTimeStampToDate(timestamp) {
  //function parses mysql datetime string and returns javascript Date object
  //input has to be in this format: 2007-06-05 15:26:02
  var regex =
    /^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
  var parts = timestamp.replace(regex, "$1 $2 $3 $4 $5 $6").split(" ");
  var isoStr = new Date(
    parts[0],
    parts[1] - 1,
    parts[2],
    parts[3],
    parts[4],
    parts[5]
  ).toISOString();
  return isoStr.substring(0, isoStr.length - 1);
}

function writeDataToUpdate() {
  fetch(
    `../../../../server/php/Task/GetThisTask.php?dataId=${idTaskFromURLThis}`,
    {
      method: "GET",
      header: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    }
  )
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      body.map((el) => {
        title_input.value = el.task_name;
        description_input.value = el.task_description;
        date_input.value = mysqlTimeStampToDate(el.task_deadline);
      });
    });
}

writeDataToUpdate();

update_data_task_btn.addEventListener("click", () => {
  //Post data
  let dataProjectUpdate = {
    id_taskJS: idTaskFromURLThis,
    titleTaskJS: title_input.value,
    descTaskJS: description_input.value,
    deadlineTaskJS: date_input.value,
  };

  let error_message_update = document.getElementById("error_message_update");

  fetch(`../../../../server/php/Task/UpdateDataTask.php`, {
    method: "POST",
    body: JSON.stringify(dataProjectUpdate),
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      if (body.error) {
        error_message_update.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" id="error_alert" style="width: 100%" role="alert">
              <strong>Заполните все поля!</strong>
              <a type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
        `;
      } else {
        $("#exampleModalCenterUpdateTask").modal("hide");
        location.reload();
      }
    });
});

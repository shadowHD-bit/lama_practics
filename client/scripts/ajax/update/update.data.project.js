let title_input = document.getElementById("title_project_update");
let description_input = document.getElementById("description_project_update");
let start_date_input = document.getElementById("date_project_start_update");
let deadline_input = document.getElementById("date_project_update");
let update_data_project_btn = document.getElementById(
  "update_data_project_btn"
);
let idProjectFromURLThis = location.search.substring(1);


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
    `../../../../server/php/Project/GetThisProject.php?dataId=${idProjectFromURL}`,
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
      console.log(body);
      body.map((el) => {
        title_input.value = el.project_name;
        description_input.value = el.project_description;
        start_date_input.value = mysqlTimeStampToDate(el.project_start);
        deadline_input.value = mysqlTimeStampToDate(el.project_deadline);
      });
    });
}

writeDataToUpdate();

update_data_project_btn.addEventListener("click", () => {
  //Post data
  let dataProjectUpdate = {
    id_project: idProjectFromURLThis,
    titleProjectJS: title_input.value,
    descProjectJS: description_input.value,
    deadlineProjectJS: start_date_input.value,
    startDateProjectJS: deadline_input.value,
  };

  fetch(`../../../../server/php/Project/UpdateDataProject.php`, {
    method: "POST",
    body: JSON.stringify(dataProjectUpdate),
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (body) {
        console.log(body);
        $("#exampleModalCenter").modal("hide");
        location.reload();
    });
});

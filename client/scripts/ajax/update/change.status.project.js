//let idProjectFromURL = location.search.substring(1);

let block_change_status = document.getElementById("block_change_status");

function loadStatusInChange() {
  fetch("../../../../server/php/Project/GetStatus.php", {
    method: "GET",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      body.map((el) => {
        block_change_status.innerHTML += `
            <button onclick={changeStatus(${el.id_status})} type="button" class="list-group-item list-group-item-action">${el.status_name}</button>
        `;
      });
    });
}

loadStatusInChange()

function changeStatus(id_status) {
fetch(
  `../../../../server/php/Project/ChangeStatus.php?id_project=${idProjectFromURL}&id_status=${id_status}`,
  {
    method: "GET",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  }
).then(function (response) {
  $("#exampleModalCenterStatus").modal("hide");
  location.reload();
});
}


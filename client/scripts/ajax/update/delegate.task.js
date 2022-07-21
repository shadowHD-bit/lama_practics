let delegate_block = document.getElementById("delegate_block");
let idTaskInURL = location.search.substring(1);

fetch("../../../../server/php/User/GetUsers.php", {
  method: "GET",
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    dataLiveDelegate = body;
    body.map((user) => {
      delegate_block.innerHTML += `
      <div class="project_member" onclick="delegate(${idTaskInURL}, ${
        user.id_user
      })">
          <div class="project_member_photo" style="background-image: url('../../../../server/uploads/${
            user.photo
          }'); background-position: center; background-size: cover;"></div>
          <label for="user_project" class="project_member_fullname">${
            user.last_name + " " + user.first_name + " " + user.second_name
          }</label>
        </label>
    </div>
          `;
    });
  });

let live_search_delegate = document.getElementById("live_search_delegate");
let search_term_delegate;

live_search_delegate.addEventListener("input", () => {
  delegate_block.innerHTML = ``;
  search_term_delegate = live_search_delegate.value.toLowerCase();
  dataLiveDelegate
    .filter((item) => {
      return (
        item.first_name.toLowerCase().includes(search_term_delegate) ||
        item.last_name.toLowerCase().includes(search_term_delegate) ||
        item.second_name.toLowerCase().includes(search_term_delegate) ||
        (item.last_name + " " + item.first_name + " " + item.second_name)
          .toLowerCase()
          .includes(search_term_delegate)
      );
    })
    .map((user) => {
      delegate_block.innerHTML += `
        <div class="project_member" onclick="delegate(${idTaskInURL}, ${
        user.id_user
      })">
          <div class="project_member_photo" style="background-image: url('../../../../server/uploads/${
            user.photo
          }'); background-position: center; background-size: cover;"></div>
          <label for="user_project" class="project_member_fullname">${
            user.last_name + " " + user.first_name + " " + user.second_name
          }</label>
        </label>
    </div>
          `;
    });
});

function delegate(id_task, id_user) {
  fetch(
    `../../../../server/php/Task/Delegate.php?taskid=${id_task}&userid=${id_user}`,
    {
      method: "GET",
      header: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    }
  ).then(function () {
    $("#exampleModalCenterDelegate").modal("hide");
    location.reload();
  });
}

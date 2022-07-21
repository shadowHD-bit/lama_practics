let live_input_search_update = document.getElementById(
  "live_search_member_update"
);
let invite_block_update = document.getElementById("invite_block_update");
let idProjectFromURLThisProject = location.search.substring(1);

function writeUserNotAdded() {
  fetch(
    `../../../../server/php/Project/GetNotAddedUser.php?projectid=${idProjectFromURLThisProject}`,
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
      invite_block_update.innerHTML = ``;
      dataLive = body;
      body.map((user) => {
        invite_block_update.innerHTML += `
        <div class="project_member" onclick={addedUserInProject(${
          user.id_user
        })}>
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
  let search_term;

  live_input_search_update.addEventListener("input", () => {
    invite_block_update.innerHTML = ``;
    search_term = live_input_search_update.value.toLowerCase();
    dataLive
      .filter((item) => {
        return (
          item.first_name.toLowerCase().includes(search_term) ||
          item.last_name.toLowerCase().includes(search_term) ||
          item.second_name.toLowerCase().includes(search_term) ||
          (item.last_name + " " + item.first_name + " " + item.second_name)
            .toLowerCase()
            .includes(search_term)
        );
      })
      .map((user) => {
        invite_block_update.innerHTML = ``;
        invite_block_update.innerHTML += `
          <div class="project_member" onclick={addedUserInProject(${
            user.id_user
          })}>
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
}

let already_invite_block = document.getElementById("already_invite");

function writeAlreadyUsers() {
  fetch(
    `../../../../server/php/Project/GetAlreadyPlayers.php?projectid=${idProjectFromURLThisProject}`,
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
      already_invite_block.innerHTML = ``;

      body.map((user) => {
        already_invite_block.innerHTML += `
            <div class="project_member" onclick={deleteUserInProject(${
              user.id_user
            })}>
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
}

function addedUserInProject(id_user) {
  fetch(
    `../../../../server/php/Project/AddedUserInProject.php?projectid=${idProjectFromURLThisProject}&userid=${id_user}`,
    {
      method: "GET",
      header: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    }
  ).then(function () {
    writeUserNotAdded();
    writeAlreadyUsers();
  });
}

function deleteUserInProject(id_user) {
  fetch(
    `../../../../server/php/Project/DeleteUserInProject.php?projectid=${idProjectFromURLThisProject}&userid=${id_user}`,
    {
      method: "GET",
      header: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    }
  ).then(function () {
    writeUserNotAdded();
    writeAlreadyUsers();
  });
}

let save_change_members = document.getElementById("save_change_members");

save_change_members.addEventListener("click", () => {
  $("#exampleModalCenterUser").modal("hide");
  location.reload();
});

writeUserNotAdded();
writeAlreadyUsers();

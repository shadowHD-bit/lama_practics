let invite_block_upper = document.getElementById("invite_block_upper");

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
    dataLive = body;
    body.map((user) => {
      invite_block_upper.innerHTML += `
        <div class="project_member">
        <label class="checkbox style-c">
          <input type="radio" value="${
            user.id_user
          }" name="user_uppertask" class="checkbox_user_project"/>
          <div class="checkbox__checkmark"></div>
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

let live_search_upper = document.getElementById("live_search_upper");
let search_term_upper;

live_search_upper.addEventListener("input", () => {
  invite_block_upper.innerHTML = ``;
  search_term_upper = live_search_upper.value.toLowerCase();
  dataLive
    .filter((item) => {
      return (
        item.first_name.toLowerCase().includes(search_term_upper) ||
        item.last_name.toLowerCase().includes(search_term_upper) ||
        item.second_name.toLowerCase().includes(search_term_upper) ||
        (item.last_name + " " + item.first_name + " " + item.second_name)
          .toLowerCase()
          .includes(search_term_upper)
      );
    })
    .map((user) => {
      invite_block_upper.innerHTML += `
        <div class="project_member">
        <label class="checkbox style-c">
          <input type="radio" value="${
            user.id_user
          }" name="user_task" class="checkbox_user_project"/>
          <div class="checkbox__checkmark"></div>
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

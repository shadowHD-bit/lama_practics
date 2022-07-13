let invite_block = document.getElementById("invite_block");

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
    body.map((user) => {
      invite_block.innerHTML += `
        <div class="project_member">
        <div class="project_member_photo" style="background-image: url('../../../../server/uploads/${
          user.photo
        }'); background-position: center; background-size: cover;"></div>
        <label for="user_project" class="project_member_fullname">${
          user.last_name + " " + user.first_name + " " + user.second_name
        }</label>
        <input value="${user.id_user}" type="checkbox" name="user_project" class="checkbox_user_project">
    </div>
        `;
    });
  });

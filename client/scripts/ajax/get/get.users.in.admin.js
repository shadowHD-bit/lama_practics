let head_table_admin_user = document.getElementById("head_table_admin_user");
let body_table_admin_user = document.getElementById("body_table_admin_user");

function showUser() {
  fetch("../../../../server/php/Admin/ShowUser.php", {
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
      head_table_admin_user.innerHTML = `
          <tr>
            <th scope="col">ID</th>
            <th scope="col">ФИО</th>
            <th scope="col">Аватар</th>
            <th scope="col">Почта</th>
            <th scope="col">Номер телефона</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Удалить</th>
      </tr> 
          `;
      body_table_admin_user.innerHTML = "";
      body.map((user) => {
        body_table_admin_user.innerHTML += `
            <tr>
              <td>${user.id_user}</td>
              <td>${
                user.last_name + " " + user.first_name + " " + user.second_name
              }</td>
              <td><div class="project_member_photo" style="width: 50px; height: 50px; border-radius: 50%;background-image: url('../../../../server/uploads/${
                user.photo
              }'); background-position: center; background-size: cover;"></div></td>
              <td>${user.email}</td>
              <td>${user.phone_number}</td>
              <td>${user.date_birthday}</td>
              <td><button onclick={deleteUser(${
                user.id_user
              })} type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
              </td>
          </tr>
        `;
      });
    });
}

function deleteUser(id_user) {
  fetch(`../../../../server/php/Admin/DeleteUser.php?userid=${id_user}`, {
    method: "GET",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  }).then(function () {
    showUser();
  });
}

let added_new_admin_user_btn = document.getElementById("added_new_admin_user");

let input_new_user_name = document.getElementById("new_name");
let input_new_user_lastname = document.getElementById("new_last_name");
let input_new_user_secondname = document.getElementById("new_second_name");
let input_new_user_tel = document.getElementById("new_tel");
let input_new_user_mail = document.getElementById("new_mail");
let input_new_user_date = document.getElementById("new_date");
let input_new_user_login = document.getElementById("new_login");
let input_new_user_password = document.getElementById("new_pass");

//user phone mask
$("#new_tel").mask("+7(999)999-99-99");

function addUser() {
  //Post data
  let dataUser = {
    name: input_new_user_name.value,
    lastname: input_new_user_lastname.value,
    secondname: input_new_user_secondname.value,
    tel: input_new_user_tel.value,
    mail: input_new_user_mail.value,
    date: input_new_user_date.value,
    login: input_new_user_login.value,
    password: input_new_user_password.value,
  };

  let error_message = document.getElementById("error_message");

  fetch("../../../../server/php/Admin/CreateUser.php", {
    method: "POST",
    body: JSON.stringify(dataUser),
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      if (body.error) {
        error_message.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" id="error_alert" style="width: 100%" role="alert">
              <strong>Заполните все поля!</strong>
              <a type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
        `;
      } else {
        $("#exampleModalCenterAdded").modal("hide");
        showUser();
      }
    });
}

added_new_admin_user_btn.addEventListener("click", () => {
  addUser();
});

showUser();

// let input_live_search = document.getElementById("live_search_member");
// let search_term;

// input_live_search.addEventListener("input", () => {
//   invite_block.innerHTML = ``;
//   search_term = input_live_search.value.toLowerCase();
//   console.log(search_term);
//   dataLive
//     .filter((item) => {
//       return (
//         item.first_name.toLowerCase().includes(search_term) ||
//         item.last_name.toLowerCase().includes(search_term) ||
//         item.second_name.toLowerCase().includes(search_term) ||
//         (item.last_name + " " + item.first_name + " " + item.second_name)
//           .toLowerCase()
//           .includes(search_term)
//       );
//     })
//     .map((user) => {
//       invite_block.innerHTML += `
//         <div class="project_member">
//         <label class="checkbox style-c">
//           <input type="checkbox" value="${
//             user.id_user
//           }" name="user_project" class="checkbox_user_project"/>
//           <div class="checkbox__checkmark"></div>
//           <div class="project_member_photo" style="background-image: url('../../../../server/uploads/${
//             user.photo
//           }'); background-position: center; background-size: cover;"></div>
//           <label for="user_project" class="project_member_fullname">${
//             user.last_name + " " + user.first_name + " " + user.second_name
//           }</label>
//         </label>
//     </div>
//           `;
//     });
// });

//Get inputs user
let name_input = document.getElementById("user_name_input");
let lastname_input = document.getElementById("user_lastname_input");
let secondname_input = document.getElementById("user_secondname_input");
let date_input = document.getElementById("user_date_input");
let mail_input = document.getElementById("user_mail_input");
let tel_input = document.getElementById("user_tel_input");
let dol_input = document.getElementById("user_dol_input");

let photo = document.getElementById('photo_in_profile')
let photoChange = document.getElementById('photo_in_change')

function getDataProfile() {
  fetch("../../../../server/php/User/GetDataUser.php", {
    method: "GET",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      name_input.value = body.first_name;
      lastname_input.value = body.last_name;
      secondname_input.value = body.second_name;
      date_input.value = body.date_birthday;
      mail_input.value = body.email;
      tel_input.value = body.phone_number;
      photo.style.backgroundImage = `url('../../../../server/uploads/${body.photo}')`
      photoChange.style.backgroundImage = `url('../../../../server/uploads/${body.photo}')`
      //dol_input.value = body...
    });
}

getDataProfile();

let change_btn = document.getElementById("change_btn");

change_btn.addEventListener("click", () => {
  change_btn.innerHTML =
    change_btn.innerHTML === "Изменить данные профиля"
      ? (change_btn.innerHTML = "Сохранить изменения")
      : (change_btn.innerHTML = "Изменить данные профиля");

  if (change_btn.innerHTML !== "Изменить данные профиля") {
    mail_input.disabled = false;
    tel_input.disabled = false;
  } else {
    mail_input.disabled = true;
    tel_input.disabled = true;

    let dataChangeUser = {
      mailFetch: mail_input.value,
      telFetch: tel_input.value,
    };

    fetch("../../../../server/php/User/UpdateDataUser.php", {
      method: "POST",
      body: JSON.stringify(dataChangeUser),
      header: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    });
  }
});

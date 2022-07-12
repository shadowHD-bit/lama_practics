//href on profile user in left menu
let bio_user = document.getElementById("bio_user");
let bio_photo = document.getElementById("photo_navs");
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
    bio_user.innerHTML = `${
      body.last_name + " " + body.first_name + " " + body.second_name
    }`;
    bio_photo.style.backgroundImage = `url('../../../../server/uploads/${body.photo}')`

  });

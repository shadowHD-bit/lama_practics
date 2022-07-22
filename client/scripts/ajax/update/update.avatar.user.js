let updateAvatarBtn = document.getElementById("savedAvatarUpdate");
let updateAvatarInput = document.getElementById("updateAvatar");
let previewBlock = document.getElementById("photo_in_change");
let errorBlock = document.getElementById("change_error");

function previewImage(input) {
  let file = input.files[0];
  let reader = new FileReader();

  reader.readAsDataURL(file);
  reader.onload = function () {
    previewBlock.style.backgroundImage = `url('${reader.result}')`;
  };

  //previewBlock.style.backgroundImage = `url('${URL.createObjectURL(updateAvatarInput.value[0])}')`
}
updateAvatarBtn.addEventListener("click", () => {
  let form_data = new FormData();
  form_data.append("avatar_image", updateAvatarInput.files[0]);

  fetch("../../../../server/php/User/UpdateAvatarUser.php", {
    method: "POST",
    body: form_data,
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      if (body.error) {
        errorBlock.innerHTML = `
            <div class="alert alert-danger" role="alert">
            ${body.em}
          </div>
            `;
      } else {
        $("#exampleModalCenter").modal("hide");
        location.reload();
      }
    });
});

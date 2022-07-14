let idProjectFromURL = location.search.substring(1);
let dataThisProject = {
  dataId: idProjectFromURL,
};
let idUserCurrent;

let titleProject = document.getElementById("title_project");
let deadlineProject = document.getElementById("deadline_project");
let descriptionProject = document.getElementById("project_description");
let creatorProject = document.getElementById("creatorProject");
let playersProject = document.getElementById("ispolnitels");
let btn_block = document.getElementById("btn_owner");

//Get this user
fetch("../../../../server/php/User/GetThisUser.php", {
  method: "GET",
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    idUserCurrent = body;
  });
  
//Get data project

fetch("../../../../server/php/Project/GetThisProject.php", {
  method: "POST",
  body: JSON.stringify(dataThisProject),
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    body.map((el) => {
      titleProject.innerHTML = `
        ${el.project_name}
        `;

      deadlineProject.innerHTML = `
        ${el.project_deadline}
        `;
      descriptionProject.innerHTML = `
        ${el.project_description}
        `;
    });
  });

//Get Creator
fetch("../../../../server/php/Project/GetCreatorProject.php", {
  method: "POST",
  body: JSON.stringify(dataThisProject),
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    body.map((el) => {
      if (el.id_user == idUserCurrent) {
        btn_block.innerHTML = `
        <button type="button" class="btn btn-danger">
        Редакировать
      </button>;
        `;
      }

      creatorProject.innerHTML = `
        <div style="background-image: url('../../../../server/uploads/${
          el.photo
        }')" class="task_member_photo" id="photo_creator"></div>
        <p id="bio_creator" class="task_member_fullname task_info">${
          el.last_name + " " + el.first_name + " " + el.second_name
        }</p>
        `;
    });
  });

//Get players
fetch("../../../../server/php/Project/GetPlayersProject.php", {
  method: "POST",
  body: JSON.stringify(dataThisProject),
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    body.map((el) => {
      playersProject.innerHTML += `
        <div id="ispolnitels" class="task_member">
            <div class="task_member_photo" style="background-image: url('../../../../server/uploads/${
              el.photo
            }')"></div>
            <p class="task_member_fullname task_info">${
              el.last_name + " " + el.first_name + " " + el.second_name
            }</p>
        </div>
        `;
    });
  });

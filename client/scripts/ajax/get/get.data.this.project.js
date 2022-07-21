let idProjectFromURL = location.search.substring(1);

let titleProject = document.getElementById("title_project");
let deadlineProject = document.getElementById("deadline_project");
let start_project = document.getElementById("start_project");
let descriptionProject = document.getElementById("project_description");
let creatorProject = document.getElementById("creatorProject");
let playersProject = document.getElementById("ispolnitels");
let btn_block = document.getElementById("btn_owner");
let btn_status = document.getElementById("btn_status");
let btn_adder = document.getElementById("btn_adder");
let statusProject = document.getElementById("project_status");
let global_data;

//Get data project

fetch(
  `../../../../server/php/Project/GetThisProject.php?dataId=${idProjectFromURL}`,
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
    global_data = body;
    body.map((el) => {
      titleProject.innerHTML = `
        ${el.project_name}
        `;
      start_project.innerHTML = `
        ${el.project_start}
        `;
      deadlineProject.innerHTML = `
        ${el.project_deadline}
        `;
      statusProject.innerHTML = `
        ${el.status_name}
        `;
      descriptionProject.innerHTML = `
        ${el.project_description}
        `;
    });

    body.map((el) => {
      creatorProject.innerHTML = `
        <div style="background-image: url('../../../../server/uploads/${el.creator.avatar}')" class="task_member_photo" id="photo_creator"></div>
        <p id="bio_creator" class="task_member_fullname task_info">${el.creator.full_name}</p>
        `;
    });

    body.map((el) => {
      el.members.map((members) => {
        playersProject.innerHTML += `
        <div id="ispolnitels" class="task_member">
            <div class="task_member_photo" style="background-image: url('../../../../server/uploads/${members.avatar}')"></div>
            <p class="task_member_fullname task_info">${members.full_name}</p>
        </div>
        `;
      });
    });
  });

fetch(
  `../../../../server/php/Project/CheckCreatorProject.php?dataId=${idProjectFromURL}`,
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
    if (body == "UserCreator") {
      btn_block.innerHTML = `
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fas fa-pen"></i> Редактировать
      </button>
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenterStatus">
        <i class="fas fa-sync"></i> Изменить статус
      </button>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenterUser">
        <i class="fas fa-user-cog"></i> Редактировать пользователей
      </button>
      <button data-toggle="modal" data-target="#exampleModalCenterdelete" type="button" class="btn btn-danger">
        <i class="fas fa-trash-alt"></i> Удалить
      </button>
    `;
    }
  });

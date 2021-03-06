import { deleteItem } from "../delete/delete.task.checklist.point.js";
import { updateItemCheckbox } from "../update/update.task.checklist.item.js";

let idProjectFromURL = location.search.substring(1);

let dataThisProject = {
  dataId: idProjectFromURL,
};

let titleTask = document.getElementById("title_task");
let deadlineTask = document.getElementById("deadline_task");
let descriptionTask = document.getElementById("description_task");
let directorTask = document.getElementById("director_task");
let performerTask = document.getElementById("performer_task");
let taskSubtasks = document.querySelector(".task_subtasks");
let taskChecklist = document.querySelector(".checklist_points");
let add_uppertask_btn = document.getElementById("add_uppertask_btn");

let project_task = document.getElementById("project_task");
let status_task = document.getElementById("status_task");
//Get data project

fetch(
  `../../../../server/php/Task/GetThisTask.php?dataId=${idProjectFromURL}`,
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
    console.log(body);
    body.map((el) => {
      titleTask.innerHTML = `
        ${el.task_name}
        `;
      deadlineTask.innerHTML = `
        ${el.task_deadline}
        `;
      descriptionTask.innerHTML = `
        ${el.task_description}
        `;
      project_task.innerHTML = `
      
        ${
          el.project_name
            ? `<a href="../ProjectItemPage/ProjectItemPage.php?${el.id_project}">${el.project_name}</a>`
            : `Нет проекта`
        }
        `;
      status_task.innerHTML = `
        ${el.status_name}
        `;
    });

    //Get director
    body.map((el) => {
      directorTask.innerHTML = `
        <div class="task_member_photo" style="background-image: url('../../../../server/uploads/${el.director.avatar}')"></div>
        <p class="task_member_fullname task_info">
            ${el.director.full_name}
        </p>
        `;
    });

    //Get performer
    body.map((el) => {
      performerTask.innerHTML = `
        <div class="task_member_photo" style="background-image: url('../../../../server/uploads/${el.performer.avatar}')"></div>
        <p class="task_member_fullname task_info">
            ${el.performer.full_name}
        </p>
        `;
    });

    //get checklist
    body.map((el) => {
      el.checklist.map((el) => {
        taskChecklist.innerHTML += `
          <div class="checklist_item" id="${el.id_point} checklist_item">
                <div class="checklist_item_text">
                <label class="checkbox style-b">
                ${
                  Number(el.isChecked)
                    ? `<input type="checkbox" name="user_project" class="point_checkbox" checked/>`
                    : `<input type="checkbox" name="user_project" class="point_checkbox"/>`
                }
                <div class="checkbox__checkmark"></div>
                <label for="user_project" class="project_member_fullname">${
                  el.point_name
                }</label>
              </label>
                </div>
                <button class="delete_item_btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        updateItemCheckbox();
      });
    });

    //Delete checklist item script
    deleteItem();

    //get subtasks
    taskSubtasks.innerHTML = `<div class="cleaner"></div>`;
    taskSubtasks.removeChild(document.querySelector(".cleaner"));
    body[0].subtasks.length ==  0 ? 
    taskSubtasks.innerHTML = `
    <div class="task_subtask">
      <span>Нет подзадач для данной задачи...</span>
    </div>
    `
    :
    body.map((el) => {
      el.subtasks.map((el) => {
        taskSubtasks.innerHTML += `
          <div class="task_subtask">
            <span><a href="../TaskPage/TaskPage.php?${el.id_task}">${el.task_name}</a></span>
            <span>|</span>
            <span>${el.task_deadline}</span>
            <span>|</span>
            <span>${el.status_name}</span>
          </div>
        `;
      });
    });
  });

//For creator

let idTaskFromURL = location.search.substring(1);

let btn_block = document.getElementById("btn_owner");

fetch(
  `../../../../server/php/Task/CheckCreatorTask.php?dataId=${idTaskFromURL}`,
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
    console.log(body);
    if (body == "UserCreator") {
      btn_block.innerHTML = `
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenterUpperTask">
        <i class="fas fa-plus"></i> Добавить подзадачу
      </button>
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenterUpdateTask">
        <i class="fas fa-pen"></i> Редактировать
      </button>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenterStatus">
        <i class="fas fa-sync"></i> Изменить статус
      </button>
      <button data-toggle="modal" data-target="#exampleModalCenterdeleteTask" type="button" class="btn btn-danger">
        <i class="fas fa-trash-alt"></i> Удалить
      </button>
      `;
    }
  });

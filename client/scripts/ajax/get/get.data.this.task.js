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
let taskChecklist = document.querySelector(".checklist_points")
//Get data project

fetch(`../../../../server/php/Task/GetThisTask.php?dataId=${idProjectFromURL}`, {
    method: "GET",

    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        console.log('Запрос на тело:')
        console.log(body)
        body.map((el) => {
            titleTask.innerHTML = `
        ${el.task_name}
        `;

            deadlineTask.innerHTML = `
        ${el.task_deadline}
        `;
            descriptionTask.innerHTML = `
        ${el.description}
        `;
        });
    });

//Get director

fetch(`../../../../server/php/Task/GetDirectorTask.php?dataId=${idProjectFromURL}`, {
    method: "GET",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        console.log('Запрос на директора');
        console.log(body);
        body.map((el) => {
            directorTask.innerHTML = `
                <div class="task_member_photo" style="background-image: url('../../../../server/uploads/${
                el.photo}')"></div>
                <p class="task_member_fullname task_info">
                    ${el.last_name + " " + el.first_name + " " + el.second_name}
                </p>
                `
        });
    });

//Get performer
fetch(`../../../../server/php/Task/GetPerformerTask.php?dataId=${idProjectFromURL}`, {
    method: "GET",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        performerTask.innerHTML = '';
        body.map((el) => {
            performerTask.innerHTML = `
         <div class="task_member_photo" style="background-image: url('../../../../server/uploads/${
                el.photo}')"></div>
                <p class="task_member_fullname task_info">
                    ${el.last_name + " " + el.first_name + " " + el.second_name}
                </p>
                
        `;
        });
    });

//Get checklist
fetch(`../../../../server/php/Task/GetTaskChecklist.php?dataId=${idProjectFromURL}`, {
    method: "GET",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        console.log("Чеклист:");
        console.log(body);
        body.map((el) => {
            taskChecklist.innerHTML += `
                 <div class="checklist_item">
                    <div class="checklist_item_text">
                        <label>
                            <input type="checkbox">
                            <p class="task_info">${el.point_name}</p>
                        </label>
                    </div>
                    <button class="delete_item_btn">
                        <p> + </p>
                    </button>
                </div>
        `;
        });
    });


//Get subtasks
fetch(`../../../../server/php/Task/GetTaskSubtasks.php?dataId=${idProjectFromURL}`, {
    method: "GET",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        console.log("Подзадачи:");
        console.log(body);
        taskSubtasks.innerHTML = `<div class="cleaner"></div>`;
        taskSubtasks.removeChild(document.querySelector(".cleaner"))
        body.map((el) => {
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

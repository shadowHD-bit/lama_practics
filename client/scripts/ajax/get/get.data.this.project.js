let idProjectFromURL = location.search.substring(1);

let dataThisProject = {
    dataId: idProjectFromURL,
};

let titleProject = document.getElementById("title_project");
let deadlineProject = document.getElementById("deadline_project");
let descriptionProject = document.getElementById("project_description");
let creatorProject = document.getElementById("creatorProject");
let playersProject = document.getElementById("ispolnitels");
let tasksProject = document.querySelector(".task_subtasks");

//Get data project

fetch(`../../../../server/php/Project/GetThisProject.php?dataId=${idProjectFromURL}`, {
    method: "GET",

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

fetch(`../../../../server/php/Project/GetCreatorProject.php?dataId=${idProjectFromURL}`, {
    method: "GET",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        console.log(body);
        body.map((el) => {
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
fetch(`../../../../server/php/Project/GetPlayersProject.php?dataId=${idProjectFromURL}`, {
    method: "POST",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        playersProject.innerHTML = '';
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

//Get tasks
fetch(`../../../../server/php/Project/GetTasksProject.php?dataId=${idProjectFromURL}`, {
    method: "GET",
    header: {
        "Content-Type": "application/json; charset=UTF-8",
    },
})
    .then(function (response) {
        return response.json();
    })
    .then(function (body) {
        console.log(body);
        console.log("Сверху такси");
        tasksProject.innerHTML = `<div class="cleaner"></div>`;
        tasksProject.removeChild(document.querySelector(".cleaner"))
        body.map((el) => {
            tasksProject.innerHTML += `
                 <div class="project_task">
                    <span><a href="#">${el.task_name}</a></span>
                    <span>|</span>
                    <span>${el.task_deadline}</span>
                    <span>|</span>
                    <span>${el.status_name}</span>
                 </div>
        `;
        });
    });

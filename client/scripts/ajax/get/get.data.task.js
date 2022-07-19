import {Loader} from "../../../components/Loader/Loader.js";

//Get element tbody in main page
let table_body_task = document.getElementById("task_user");
let table_head_task = document.getElementById("task_head");

//Func get tasks users
function get_task_user() {
    document.querySelector('.tasks_page').appendChild(Loader);
    fetch("../../../../server/php/Task/GetAllTasks.php", {
        method: "GET",
        header: {
            "Content-Type": "application/json; charset=UTF-8",
        },
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (body) {
            document.querySelector('.tasks_page').removeChild(Loader);
            table_head_task.innerHTML += `
                 <tr>
                    <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                        <span className="title">
                            Название
                        </span>
                    </td>
                    <td>
                        <span className="director">
                            Постановщик
                        </span>
                    </td>
                    <td>
                        <span className="executor">
                            Ответственный
                        </span>
                    </td>
                    <td>
                        <span className="project">
                            Проект
                        </span>
                    </td>
                    <td>
                        <span className="date">
                            Сроки
                        </span>
                    </td>
                    <td style="border-bottom-right-radius: 10px; border-top-right-radius: 10px">
                        <span className="status">
                            Статус
                        </span>
                    </td>
                </tr>`
            body.map((el) => {
                table_body_task.innerHTML += `
            <tr>
                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    <span class="title">
                        ${el.task_name}
                     </span>
                </td>
                <td>
                     <span class="director">
                        ${el.director}
                    </span>
                </td>
                <td>
                    <span class="executor">
                        ${el.executor}
                    </span>
                </td>
                <td>
                     <span class="project">
                        ${el.project_name}
                    </span>
                 </td>
                <td>
                    <span class="date">
                        ${el.task_deadline}
                    </span>
                 </td>
                 <td style="border-bottom-right-radius: 10px; border-top-right-radius: 10px">
                     <span class="status">
                        ${el.status_name}
                    </span>
                </td>
            </tr>
            `;
            });
        });
}

get_task_user();

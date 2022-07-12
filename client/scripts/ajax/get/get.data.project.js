import {Loader} from "../../../components/Loader/Loader.js";

//Get element tbody in main page
let table_body_project = document.getElementById("project_user");
let table_head_project = document.getElementById("project_head");

//Func get tasks users
function get_project_user() {
    document.querySelector('.projects_page').appendChild(Loader);
    fetch("../../../../server/php/Project/GetProjectUser.php", {
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
            document.querySelector('.projects_page').removeChild(Loader);
            table_head_project.innerHTML =
                `
                <tr>
                    <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                        <span className="title">
                            Название
                        </span>
                    </td>
                    <td>
                        <span className="description">
                            Описание
                        </span>
                    </td>
                    <td>
                        <span className="creator">
                            Организатор
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
                table_body_project.innerHTML += `
            <tr>
                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    <span class="title">
                        ${el.project_name}
                     </span>
                </td>
                <td>
                     <span class="description">
                        ${el.project_description}
                    </span>
                </td>
                <td>
                    <span class="creator">
                        ${el.project_name}
                    </span>
                </td>
                <td>
                    <span class="date">
                        ${el.project_deadline}
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

get_project_user();
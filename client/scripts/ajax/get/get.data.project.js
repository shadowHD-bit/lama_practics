//Get element tbody in main page
let table_body_project = document.getElementById("project_user");

//Func get tasks users
function get_project_user() {
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
                        ${el.last_name + ' ' + el.first_name + ' ' + el.second_name}
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
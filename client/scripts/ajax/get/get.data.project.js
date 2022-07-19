import { Loader } from "../../../components/Loader/Loader.js";

//Get element tbody in main page
let table_body_project = document.getElementById("project_user");
let table_head_project = document.getElementById("project_head");
let global_data;
//Func get tasks users
function get_project_user() {
  document.querySelector(".projects_page").appendChild(Loader);
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
      global_data = body;
      document.querySelector(".projects_page").removeChild(Loader);
      table_head_project.innerHTML = `
        <tr>
            <td id="sort_title" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                <span className="title">
                    Название
                    <i id="sort_title_icon" class="fas fa-sort"></i>
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
                <span id="sort_date" className="date">
                    Сроки
                    <i id="sort_date_icon" class="fas fa-sort"></i>
                </span>
            </td>
            <td id="sort_status" style="border-bottom-right-radius: 10px; border-top-right-radius: 10px">
                <span className="status">
                    Статус
                </span>
            </td>
        </tr>
        <tr class="sort_head_table">
            <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                <span>
                    <input class="lives_project" id="live_search_title" type="text" />
                </span>
            </td>
            <td>
                <span>
                    <input class="lives_project" id="live_search_description" type="text" />
                </span>
            </td>
            <td>
                <span>
                    <input class="lives_project" id="live_search_creator" type="text" />
                </span>
            </td>
            <td>
                <span>
                    <input class="lives_project" id="live_search_date" type="text" />
                </span>
            </td>
            <td style="border-bottom-right-radius: 10px; border-top-right-radius: 10px">
                <span>
                    <input class="lives_project" id="live_search_status" type="text" />
                </span>
            </td>
        </tr>`;
      body.map((el) => {
        table_body_project.innerHTML += `
            <tr>
                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    <span class="title">
                    <a href="../ProjectItemPage/ProjectItemPage.php?${
                      el.id_project
                    }">  ${el.project_name} </a>
                    </span>
                </td>
                <td>
                    <span class="description">
                    ${el.project_description.substring(0, 40)}...
                    </span>
                </td>
                <td>
                    <span class="creator">
                        ${el.creator}
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

      let data_project = body;

      //------------------live sort data

      let live_sort_data;

      let live_search_title = document.getElementById("live_search_title");
      let live_search_description = document.getElementById(
        "live_search_description"
      );
      let live_search_creator = document.getElementById("live_search_creator");
      let live_search_date = document.getElementById("live_search_date");
      let live_search_status = document.getElementById("live_search_status");

      let search_term_title;
      let search_term_description;
      let search_term_creator;
      let search_term_date;
      let search_term_status;

      let all_inputs_live = document.querySelectorAll(".lives_project");
      live_sort_data = data_project;
      all_inputs_live.forEach(function (inp) {
        inp.addEventListener("input", () => {
          search_term_title = live_search_title.value.toLowerCase();
          search_term_description = live_search_description.value.toLowerCase();
          search_term_creator = live_search_creator.value.toLowerCase();
          search_term_date = live_search_date.value.toLowerCase();
          search_term_status = live_search_status.value.toLowerCase();

          live_sort_data = data_project.filter((item) => {
            return (
              item.project_name.toLowerCase().includes(search_term_title) &&
              item.project_description
                .toLowerCase()
                .includes(search_term_description) &&
              item.creator.toLowerCase().includes(search_term_creator) &&
              item.project_deadline.toLowerCase().includes(search_term_date) &&
              item.status_name.toLowerCase().includes(search_term_status)
            );
          });
          write_sort_data(live_sort_data);
        });
      });

      let sort_data = data_project;
      let sort_title = document.getElementById("sort_title");
      let sort_date = document.getElementById("sort_date");
      //let sort_status = document.getElementById("sort_title");

      let sort_title_icon = document.getElementById("sort_title_icon");
      let sort_date_icon = document.getElementById("sort_date_icon");
      //let sort_status_icon = document.getElementById("sort_title_icon");

      //Sort in title
      sort_title.addEventListener("click", () => {
        //check other field
        if (
          sort_date_icon.classList.contains("fa-sort-up") ||
          sort_date_icon.classList.contains("fa-sort-down")
        ) {
          sort_date_icon.classList.remove("fa-sort-down");
          sort_date_icon.classList.remove("fa-sort-up");
          sort_date_icon.classList.add("fa-sort");
        }

        if (sort_title_icon.classList.contains("fa-sort")) {
          sort_title_icon.classList.toggle("fa-sort");
          sort_title_icon.classList.toggle("fa-sort-down");
          sort_data = live_sort_data.sort((a, b) => {
            if (a.project_name < b.project_name) {
              return 1;
            }
            if (a.project_name > b.project_name) {
              return -1;
            }
            return 0;
          });
        } else if (sort_title_icon.classList.contains("fa-sort-down")) {
          sort_title_icon.classList.toggle("fa-sort-down");
          sort_title_icon.classList.toggle("fa-sort-up");
          sort_data = live_sort_data.sort((a, b) => {
            if (a.project_name < b.project_name) {
              return -1;
            }
            if (a.project_name > b.project_name) {
              return 1;
            }
            return 0;
          });
        } else if (sort_title_icon.classList.contains("fa-sort-up")) {
          sort_title_icon.classList.toggle("fa-sort-up");
          sort_title_icon.classList.toggle("fa-sort");
          sort_data = live_sort_data.sort((a, b) => {
            if (a.id_project < b.id_project) {
              return -1;
            }
            if (a.id_project > b.id_project) {
              return 1;
            }
            return 0;
          });
        }
        write_sort_data(sort_data);
      });

      //Sort in date
      sort_date.addEventListener("click", () => {
        //check other field
        if (
          sort_title_icon.classList.contains("fa-sort-up") ||
          sort_title_icon.classList.contains("fa-sort-down")
        ) {
          sort_title_icon.classList.remove("fa-sort-down");
          sort_title_icon.classList.remove("fa-sort-up");
          sort_title_icon.classList.add("fa-sort");
        }

        if (sort_date_icon.classList.contains("fa-sort")) {
          sort_date_icon.classList.toggle("fa-sort");
          sort_date_icon.classList.toggle("fa-sort-down");
          sort_data = live_sort_data.sort((a, b) => {
            if (a.project_deadline < b.project_deadline) {
              return 1;
            }
            if (a.project_deadline > b.project_deadline) {
              return -1;
            }
            return 0;
          });
        } else if (sort_date_icon.classList.contains("fa-sort-down")) {
          sort_date_icon.classList.toggle("fa-sort-down");
          sort_date_icon.classList.toggle("fa-sort-up");
          sort_data = live_sort_data.sort((a, b) => {
            if (a.project_deadline < b.project_deadline) {
              return -1;
            }
            if (a.project_deadline > b.project_deadline) {
              return 1;
            }
            return 0;
          });
        } else if (sort_date_icon.classList.contains("fa-sort-up")) {
          sort_date_icon.classList.toggle("fa-sort-up");
          sort_date_icon.classList.toggle("fa-sort");
          sort_data = live_sort_data.sort((a, b) => {
            if (a.id_project < b.id_project) {
              return -1;
            }
            if (a.id_project > b.id_project) {
              return 1;
            }
            return 0;
          });
        }
        write_sort_data(sort_data);
      });
    });
}

function write_sort_data(data) {
  table_body_project.innerHTML = ``;
  data.map((el) => {
    table_body_project.innerHTML += `
        <tr style="margin-bottom: 10px">
            <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                <span class="title">
                <a href="../ProjectItemPage/ProjectItemPage.php?${
                  el.id_project
                }">  ${el.project_name} </a>
                </span>
            </td>
            <td>
                <span class="description">
                    ${el.project_description.substring(0, 40)}...
                </span>
            </td>
            <td>
                <span class="creator">
                    ${el.creator}
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
}

get_project_user();

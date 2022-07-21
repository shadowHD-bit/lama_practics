import { Loader } from "../../../components/Loader/Loader.js";

//Get element tbody in main page
let table_body_task = document.getElementById("task_user");
let table_head_task = document.getElementById("task_head");
let global_data;
//Func get tasks users
function get_task_user() {
  document.querySelector(".tasks_page").appendChild(Loader);
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
      global_data = body;
      document.querySelector(".tasks_page").removeChild(Loader);
      table_head_task.innerHTML += `
        <tr>
        <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
            <span className="title">
                Название
            </span>
        </td>
        <td>
            <span className="poster">
                Постановщик
            </span>
        </td>
        <td>
            <span className="mainer">
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
    </tr>
    <tr class="sort_head_table">
    <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
        <span>
            <input class="lives_project" id="live_search_title" type="text" />
        </span>
    </td>
    <td>
        <span>
            <input class="lives_project" id="live_search_creator" type="text" />
        </span>
    </td>
    <td>
        <span>
            <input class="lives_project" id="live_search_excutor" type="text" />
        </span>
    </td>
    <td>
        <span>
            <input class="lives_project" id="live_search_project" type="text" />
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
        table_body_task.innerHTML += `
            <tr>
                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    <span class="title">
                     <a href="../TaskPage/TaskPage.php?${el.id_task}">${
          el.task_name
        }</a>
                    </span>
            </td>
            <td>
                    <span class="poster">
                    ${el.director}
                </span>
            </td>
            <td>
                <span class="mainer">
                    ${el.executor}
                </span>
            </td>
            <td>
                    <span class="project">
                    ${
                      el.project_name
                        ? `<a href="../ProjectItemPage/ProjectItemPage.php?${el.id_project}">${el.project_name}</a>`
                        : `Нет проекта`
                    }
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

      let data_project = body;
      let live_sort_data;

      let live_search_title = document.getElementById("live_search_title");
      let live_search_project = document.getElementById("live_search_project");
      let live_search_creator = document.getElementById("live_search_creator");
      let live_search_ex = document.getElementById("live_search_excutor");
      let live_search_date = document.getElementById("live_search_date");
      let live_search_status = document.getElementById("live_search_status");

      let search_term_title;
      let search_term_project;
      let search_term_ex;
      let search_term_creator;
      let search_term_date;
      let search_term_status;

      let null_project = "Нет проекта";

      let all_inputs_live = document.querySelectorAll(".lives_project");
      live_sort_data = data_project;
      all_inputs_live.forEach(function (inp) {
        inp.addEventListener("input", () => {
          search_term_title = live_search_title.value.toLowerCase();
          search_term_ex = live_search_ex.value.toLowerCase();
          search_term_creator = live_search_creator.value.toLowerCase();
          search_term_project = live_search_project.value.toLowerCase();
          search_term_date = live_search_date.value.toLowerCase();
          search_term_status = live_search_status.value.toLowerCase();

          live_sort_data = data_project.filter((item) => {
            item.project_name != null
              ? (null_project = item.project_name)
              : (null_project = "Нет проекта");
            return (
              item.task_name.toLowerCase().includes(search_term_title) &&
              item.director.toLowerCase().includes(search_term_creator) &&
              item.executor.toLowerCase().includes(search_term_ex) &&
              null_project.toLowerCase().includes(search_term_project) &&
              item.task_deadline.toLowerCase().includes(search_term_date) &&
              item.status_name.toLowerCase().includes(search_term_status)
            );
          });
          write_sort_data(live_sort_data);
        });
      });
    });
}

function write_sort_data(data) {
  table_body_task.innerHTML = ``;
  data.map((el) => {
    table_body_task.innerHTML += `
            <tr>
                <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                    <span class="title">
                     <a href="../TaskPage/TaskPage.php?${el.id_task}">${
      el.task_name
    }</a>
                    </span>
            </td>
            <td>
                    <span class="poster">
                    ${el.director}
                </span>
            </td>
            <td>
                <span class="mainer">
                    ${el.executor}
                </span>
            </td>
            <td>
                    <span class="project">
                    ${
                      el.project_name
                        ? `<a href="../ProjectItemPage/ProjectItemPage.php?${el.id_project}">${el.project_name}</a>`
                        : `Нет проекта`
                    }
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
}

get_task_user();

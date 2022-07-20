let project_block = document.getElementById("project_block");

fetch(`../../../../server/php/Project/GetProjectUserCreator.php`, {
  method: "GET",
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    data_proj = body;
    body.map((proj) => {
      project_block.innerHTML += `
        <div class="project_member">
        <label class="checkbox style-c">
          <input type="radio" value="${proj.id_project}" name="task_project" class="checkbox_user_project"/>
          <div class="checkbox__checkmark"></div>
         <label for="user_project" class="project_member_fullname">${proj.project_name}</label>
        </label>
    </div>
          `;
    });
  });

let live_search_project = document.getElementById("live_search_project");
let search_term_proj;

live_search_project.addEventListener("input", () => {
    project_block.innerHTML = ``;
  search_term_proj = live_search_project.value.toLowerCase();
  data_proj
    .filter((item) => {
      return item.project_name.toLowerCase().includes(search_term_proj);
    })
    .map((proj) => {
      project_block.innerHTML += `
      <div class="project_member">
      <label class="checkbox style-c">
        <input type="radio" value="${proj.id_project}" name="task_project" class="checkbox_user_project"/>
        <div class="checkbox__checkmark"></div>
       <label for="user_project" class="project_member_fullname">${proj.project_name}</label>
      </label>
  </div>
          `;
    });
});

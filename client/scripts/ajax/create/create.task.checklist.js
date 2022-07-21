import {deleteItem} from "../delete/delete.task.checklist.point.js";
import {updateItemCheckbox} from "../update/update.task.checklist.item.js";

let idTaskFromURL = location.search.substring(1);
let add_item_btn = document.getElementById("add_checklist_item_btn");
let new_checklist_item = document.querySelector(".input_checklist");
let checklist = document.querySelector(".checklist_points");


add_item_btn.addEventListener("click", () => {

    //input field when click on btn
    new_checklist_item.style.display = "block";
    new_checklist_item.innerHTML = `
     <input placeholder="Введите задачу" class="input_field" id="checklist_input">
    `

    //smt happen when focus out
    let checklist_input = document.getElementById("checklist_input");
    checklist_input.focus();
    checklist_input.onblur = () => {
        let dataChecklist = {
            valueJS: checklist_input.value,
            taskId: Number(idTaskFromURL),
        };
        if (checklist_input.value !== "") {
            checklist_input.disabled = true;
            //There will be POST query
            fetch(`../../../../server/php/Task/CreateTaskChecklistItem.php`, {
                method: "POST",
                body: JSON.stringify(dataChecklist),
                header: {
                    "Content-Type": "application/json; charset=UTF-8",
                },
            })
                .then((response) => {
                    return response.json();
                })
                .then((body) => {
                    let el = body[body.length - 1];
                    new_checklist_item.style.display = "none";
                    new_checklist_item.innerHTML = "";
                    checklist.innerHTML += `
                <div class="checklist_item" id="${el.id_point} checklist_item">
                    <div class="checklist_item_text">
                        <label>
                            <input type="checkbox" class="point_checkbox">
                            <p class="task_info">${checklist_input.value}</p>
                        </label>
                    </div>
                    <button class="delete_item_btn">
                        <p> + </p>
                    </button>
                </div>`

                    //Delete checklist item script
                    deleteItem();
                    //Update checklist item script
                    updateItemCheckbox()
                })

        }


}


}
)


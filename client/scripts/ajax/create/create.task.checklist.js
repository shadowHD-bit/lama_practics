function createChecklist() {
    let add_item_btn = document.getElementById("add_checklist_item_btn");
    let new_checklist_item = document.querySelector(".input_checklist");
    let checklist = document.querySelector(".checklist_points");
    new_checklist_item.style.display = "block";
    new_checklist_item.innerHTML = `
     <input placeholder="Введите задачу" class="input_field" id="checklist_input">
    `
    let checklist_input = document.getElementById("checklist_input");
    checklist_input.focus();
    checklist_input.onblur = () => {
        //There will be POST query
        new_checklist_item.style.display = "none";
        new_checklist_item.innerHTML = "";
        checklist.innerHTML += `
            <div class="checklist_item">
                <div class="checklist_item_text">
                    <label>
                        <input type="checkbox">
                        <p class="task_info">Задача</p>
                    </label>
                </div>
                <button class="delete_item_btn">
                    <p> + </p>
                </button>
            </div>
        `
        console.log('отправлен на сервер');

    }
}


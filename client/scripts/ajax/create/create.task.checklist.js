function createChecklist() {
    let idTaskFromURL = location.search.substring(1);
    let add_item_btn = document.getElementById("add_checklist_item_btn");
    let new_checklist_item = document.querySelector(".input_checklist");
    let checklist = document.querySelector(".checklist_points");

    //input field when click on btn
    new_checklist_item.style.display = "block";
    new_checklist_item.innerHTML = `
     <input placeholder="Введите задачу" class="input_field" id="checklist_input">
    `

    //smt happen when focus out
    let checklist_input = document.getElementById("checklist_input");
    checklist_input.focus();
    checklist_input.onblur = () => {
        checklist_input.disabled = true;

        let dataChecklist = {
            valueJS: checklist_input.value,
            taskId: Number(idTaskFromURL),
        };
        //There will be POST query
        fetch(`../../../../server/php/Task/CreateTaskChecklistItem.php`, {
            method: "POST",
            body: JSON.stringify(dataChecklist),
            header: {
                "Content-Type": "application/json; charset=UTF-8",
            },
        })
            .then((response) => {
                console.log(response);

                new_checklist_item.style.display = "none";
                new_checklist_item.innerHTML = "";
                checklist.innerHTML += `
                <div class="checklist_item">
                    <div class="checklist_item_text">
                        <label>
                            <input type="checkbox">
                            <p class="task_info">${checklist_input.value}</p>
                        </label>
                    </div>
                    <button class="delete_item_btn">
                        <p> + </p>
                    </button>
                </div>
                `
                deleteItem();
            })

        function deleteItem() {
            console.log("zhopa");
            let btns = document.querySelectorAll('.delete_item_btn');
            console.log(btns)
            // Проходим по массиву
            btns.forEach(function (btn) {
                // Вешаем событие клик
                btn.addEventListener('click', function () {
                    let pointId = parseInt(btn.parentElement.id);
                    fetch(`../../../../server/php/Task/DeleteTaskChecklistItem.php?pointId=${pointId}`, {
                        method: "DELETE",
                        header: {
                            "Content-Type": "application/json; charset=UTF-8",
                        },
                    })
                        .then(function (response) {
                            btn.parentElement.remove();
                        })
                })
            })

        }
    }
}


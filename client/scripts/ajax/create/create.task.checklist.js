let add_item_btn = document.getElementById("add_checklist_item_btn");
let new_checklist_item = add_item_btn.parentElement;
add_item_btn.addEventListener("click", () => {
    new_checklist_item.innerHTML = `
     <input placeholder="Введите задачу" class="input_field">
    `
})

let create_checklist_item = () => {
    fetch()
}
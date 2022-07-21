export function deleteItem() {

    let btns = document.querySelectorAll('.delete_item_btn');
    console.log(btns)
// Проходим по массиву
    btns.forEach(function (btn) {
        // Вешаем событие клик
        btn.addEventListener('click', function () {
            let pointId = parseInt(btn.parentElement.id);
            btn.disabled = true;
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
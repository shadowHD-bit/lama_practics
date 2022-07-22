export function deleteItem() {
  let btns = document.querySelectorAll(".delete_item_btn");

  // Проходим по массиву
  btns.forEach(function (btn) {
    // Вешаем событие клик
    btn.addEventListener("click", function () {
      let pointId = parseInt(btn.parentElement.id);
      btn.disabled = true;
      fetch(
        `../../../../server/php/Task/DeleteTaskChecklistItem.php?pointId=${pointId}`,
        {
          method: "DELETE",
          header: {
            "Content-Type": "application/json; charset=UTF-8",
          },
        }
      ).then(function () {
        btn.parentElement.remove();
      });
    });
  });
}

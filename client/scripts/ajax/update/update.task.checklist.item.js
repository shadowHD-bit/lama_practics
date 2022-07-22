export function updateItemCheckbox() {
  let checkboxes = document.querySelectorAll(".point_checkbox");
  // Проходим по массиву
  checkboxes.forEach(function (checkbox) {
    // Вешаем событие клик
    checkbox.addEventListener("click", function () {
      let checkboxParentItemId = parseInt(
        checkbox.closest(".checklist_item").id
      );
      let checkboxStatus = checkbox.checked ? 1 : 0;

      let queryData = {
        pointId: checkboxParentItemId,
        checkboxStatus: checkboxStatus,
      };

      checkbox.disabled = true;

      fetch(`../../../../server/php/Task/UpdateTaskChecklistItem.php`, {
        method: "POST",
        body: JSON.stringify(queryData),
        header: {
          "Content-Type": "application/json; charset=UTF-8",
        },
      }).then(function (response) {
        checkbox.disabled = false;
      });
    });
  });
}

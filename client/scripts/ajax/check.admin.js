fetch("../../../server/php/User/CheckAdmin.php", {
    method: "GET",
    header: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (body) {
      if (!body.access) {
          window.location.href = "../MainPage/MainPage.php";
      }
    });
  
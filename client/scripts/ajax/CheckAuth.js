fetch("../../../server/php/Auth/CheckAuth.php", {
  method: "POST",
  header: {
    "Content-Type": "application/json; charset=UTF-8",
  },
})
  .then(function (response) {
    return response.json();
  })
  .then(function (body) {
    console.log(body);
    if (!body.access) {
      window.location.href = "../AuthPage/AuthPage.php";
    }
  });

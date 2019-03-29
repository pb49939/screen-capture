var formValid;

$("#btn-sign-in").click(function() {
  formValid = true;
  var username = validateNotNull("Username", $("#username").val());
  var password = validateNotNull("Password", $("#password").val());

  if (formValid) {
    submitLogin(username, password);
  }
});

function validateNotNull(paramaterName, paramater) {
  if ((formValid && paramater == "") || (paramater == null && formValid)) {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      type: "error",
      title: paramaterName + " is a required field"
    });

    formValid = false;
  }

  return paramater || "";
}

function submitLogin(username, password) {
  var serializedData = new Object();
  serializedData.username = username;
  serializedData.password = password;

  d_login(serializedData).then(
    user => {
      if (user == "authenticated") {
        document.getElementById("authenticated").click();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          type: "error",
          title: "Incorrect Credentials"
        });
      }
    },
    () => {}
  );
}

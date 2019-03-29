var formValid;

$("#btn-submit-developer").click(function() {
  formValid = true;
  var username = validateNotNull("Username", $("#d-username").val());
  var firstName = validateNotNull("First Name", $("#d-first-name").val());
  var lastName = validateNotNull("Last Name", $("#d-last-name").val());
  var email = validateNotNull("Email", $("#d-email").val());
  var password = validateNotNull("Password", $("#d-password").val());
  var passwordConfirm = validateNotNull(
    "Confirm Password",
    $("#d-confirm-password").val()
  );

  validatePasswordMatch(password.toString(), passwordConfirm.toString());

  if (formValid) {
    submitRegistration(
      username,
      firstName,
      lastName,
      email,
      password,
      "DEVELOPER"
    );
  }
});

$("#btn-submit-user-tester").click(function() {
  formValid = true;
  var username = validateNotNull("Username", $("#ut-username").val());
  var firstName = validateNotNull("First Name", $("#ut-first-name").val());
  var lastName = validateNotNull("Last Name", $("#ut-last-name").val());
  var email = validateNotNull("Email", $("#ut-email").val());
  var password = validateNotNull("Password", $("#ut-password").val());
  var passwordConfirm = validateNotNull(
    "Confirm Password",
    $("#ut-confirm-password").val()
  );

  validatePasswordMatch(password.toString(), passwordConfirm.toString());

  if (formValid) {
    submitRegistration(
      username,
      firstName,
      lastName,
      email,
      password,
      "USER_TESTER"
    );
  }
});

function validatePasswordMatch(string1, string2) {
  if (string1.toUpperCase() != string2.toUpperCase() && formValid) {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      type: "error",
      title: "Passwords do not match"
    });

    formValid = false;
  }
}

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

function submitRegistration(
  username,
  firstName,
  lastName,
  email,
  password,
  userType
) {
  var serializedData = new Object();
  serializedData.username = username;
  serializedData.firstName = firstName;
  serializedData.lastName = lastName;
  serializedData.email = email;
  serializedData.password = password;
  serializedData.userType = userType;

  d_saveNewUser(serializedData).then(
    user => {
      alert("done");
    },
    () => {}
  );
}

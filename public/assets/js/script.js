var matchPassword = function () {
  if (
    document.getElementById("create_password").value ==
    document.getElementById("confirm_password").value
  ) {
    document.getElementById("message").classList.add("text-success");
    document.getElementById("message").classList.remove("text-danger");
    document.getElementById("message").innerHTML = "Mot de passe correspondant";
    document.getElementById("create_submit").disabled = false;
    document.getElementById("confirm_password").classList.add("is-valid");
    document.getElementById("confirm_password").classList.remove("is-invalid");
  } else {
    document.getElementById("message").classList.add("text-danger");
    document.getElementById("message").innerHTML =
      "Les mots de passes de correspondent pas";
    document.getElementById("create_submit").disabled = true;
    document.getElementById("confirm_password").classList.remove("is-valid");
    document.getElementById("confirm_password").classList.add("is-invalid");
  }
};

var checkPassword = function () {
  let password = document.getElementById("create_password");
  let nbcar = document.getElementById("nbcar");
  let majcar = document.getElementById("majcar");
  let speccar = document.getElementById("speccar");

  let nbcarCheck = false;
  let majcarCheck = false;
  let speccarCheck = false;

  if (password.value.length > 5) {
    nbcar.classList.add("text-success");
    nbcar.classList.remove("text-danger");
    nbcarCheck = true;
  } else {
    nbcar.classList.remove("text-success");
    nbcar.classList.add("text-danger");
    nbcarCheck = false;
  }

  if (password.value.match(/[A-Z]/)) {
    majcar.classList.add("text-success");
    majcar.classList.remove("text-danger");
    majcarCheck = true;
  } else {
    majcar.classList.remove("text-success");
    majcar.classList.add("text-danger");
    nbcarCheck = false;
  }

  if (password.value.match(/[^A-Za-z0-9 ]/)) {
    speccar.classList.add("text-success");
    speccar.classList.remove("text-danger");
    speccarCheck = true;
  } else {
    speccar.classList.remove("text-success");
    speccar.classList.add("text-danger");
    speccarCheck = false;
  }

  if (speccarCheck && nbcarCheck && majcarCheck) {
    password.classList.add("is-valid");
    password.classList.remove("is-invalid");
    document.getElementById("confirm_password").disabled = false;
  } else {
    password.classList.add("is-invalid");
    password.classList.remove("is-valid");
    document.getElementById("confirm_password").disabled = true;
  }

  matchPassword();
};

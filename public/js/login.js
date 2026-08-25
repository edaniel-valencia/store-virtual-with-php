//LOGIN
console.clear();

function irDespuesDeAutenticar() {
  const redirect = localStorage.getItem('postLoginRedirect');
  localStorage.removeItem('postLoginRedirect');
  setTimeout(function () {
    if (redirect) {
      window.location = ruta + redirect;
    } else {
      window.location.reload();
    }
  }, 1500);
}

const email = document.querySelector("#email");
const password = document.querySelector("#password");
const btnLogin = document.querySelector("#btnLogin");

//REGISTER
const nameRegister = document.querySelector("#nameRegister");
const emailRegister = document.querySelector("#emailRegister");
const passwordRegister = document.querySelector("#passwordRegister");
const btnRegister = document.querySelector("#btnRegister");

document.addEventListener("DOMContentLoaded", function () {
  btnLogin.onclick = function (e) {
    e.preventDefault();
    if (email.value == "" || password.value == "") {
      alerta("INGRESA CORREO Y CONTRASEÑA", 2);
    } else {
      let data = new FormData();
      data.append("email", email.value);
      data.append("clave", password.value);
      const url = ruta + "profile/validar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            irDespuesDeAutenticar();
          }
          let type = res.icono == "success" ? 1 : 2;
          alerta(res.msg.toUpperCase(), type);
        }
      };
    }
  };
  btnRegister.onclick = function (e) {
    e.preventDefault();
    if (nameRegister.value == "" || emailRegister.value == "" || passwordRegister.value == "") {
      alerta("TODO LOS CAMPOS SON REQUERIDOS", 2);
    } else {
      let data = new FormData();
      data.append("nombre", nameRegister.value);
      data.append("email", emailRegister.value);
      data.append("clave", passwordRegister.value);
      const url = ruta + "registro/save";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            irDespuesDeAutenticar();
          }
          let type = res.icono == "success" ? 1 : 2;
          alerta(res.msg.toUpperCase(), type);
        }
      };
    }
  };
});

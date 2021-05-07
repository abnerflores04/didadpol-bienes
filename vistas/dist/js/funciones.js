function mostrarPassword_login() {
    var cambio = document.getElementById("contra");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.mostrar').removeClass('fas fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.mostrar').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
    }
}

function mostrarConfPassword_login() {
    var cambio = document.getElementById("conf_contra");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.confmostrar').removeClass('fas fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.confmostrar').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
    }
}
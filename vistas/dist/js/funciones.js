function mostrarPassword_login() {
    var cambio2 = document.getElementById("contra");
    if (cambio2.type == "password") {
        cambio2.type = "text";
        $('.icon2').removeClass('fas fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio2.type = "password";
        $('.icon2').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
    }
}
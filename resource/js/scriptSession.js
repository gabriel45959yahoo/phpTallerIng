function redireccionar() {
    // $("#body").load("../control/SessionController.php");
    $.ajax({
        type: "POST",
        url: "../control/SessionController.php",
        data: {
            datos: "datos"
        },
        success: function (data) {
            var datos = data.replace("\n","");
            //data es la respuesta del php
            if (!datos.includes("<nav")) {
                if(datos.includes("no login")){
                    window.location.assign('/index.html');
                }else{
                    check("error", "Error Login", datos);
                }
                return false;
            }
              $("#menuid").append(datos);
            return true;
        }
    });
};

$(function () {
    $("#acceder").click(function () {
        var url = "../control/LoginController.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#login").serialize(),
            success: function (data) {
                if (!data.includes("Error")) {
                  
                  window.location.assign('/view/home.html');
                 
                } else {
                    check("error", "Error Login", data);
                }
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
});

function logout() {
        var url = "../control/LogoutController.php";
        $.ajax({
            type: "POST",
            url: url,
            success: function (data) {

                window.location.assign('../index.html');

            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    }

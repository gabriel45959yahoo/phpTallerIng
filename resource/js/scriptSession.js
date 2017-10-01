function redireccionar() {
    // $("#body").load("../control/SessionController.php");
     $.ajax({
         type: "POST",
         url: "../control/SessionController.php",
         data: {datos:"datos"},
         success: function (data) {
           //data es la respuesta del php
           if(data == "error"){
        	   window.location.assign('/index.html');
           }
       }
 });
};


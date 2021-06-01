function Enviar() {
    var parametros = {
        "correo":$('#email').val()
    };
    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: './controlador/seguridad/confirmarCorreo.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
            success: function (respuesta) {
                alert(respuesta['respuesta']);
                if (respuesta['estado']) {
                    // window.open('reset-Password.html','_self'); 
                    document.getElementById("txtOlvido").className = "d-none";
                    document.getElementById("txtRestablece").className = "text-dark mb-2";
                    document.getElementById("txtMensaje").className = "d-none";
                    document.getElementById("frmEmail").className = "d-none";
                    document.getElementById("frmRestablece").className = "";
                }
            }
    })
}
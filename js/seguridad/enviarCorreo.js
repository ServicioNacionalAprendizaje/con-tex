function Enviar() {
    var parametros = {
        "correo":$('#email').val()
    };
    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/enviarCorreo.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
            success: function (respuesta) {
                alert(respuesta['respuesta']);
            }
    })
}
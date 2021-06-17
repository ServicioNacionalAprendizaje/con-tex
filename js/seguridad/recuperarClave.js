function Enviar(accion, id) {
    if (id === null) {
        id = $('#hidIdUsuario').val();
    }
    var parametros = {        
        "usuario": $('#txtUsuario').val(),
        "accion": accion
    };

    $.ajax({
        data: parametros, //datos que se van a enviar al ajax
        url: '../../con-tex/controlador/seguridad/usuario.C.php', //archivo php que recibe los datos
        type: 'post', //método para enviar los datos
        dataType: 'json', //Recibe el array desde php

        success: function(respuesta) { //procesa y devuelve la respuesta
            console.log(respuesta)

            //Respuesta eliminar
            if (respuesta['accion'] == 'RESTAURAR') {
                alert(respuesta['respuesta']);
                window.location = respuesta['ruta'];
            }
        }
    });
}

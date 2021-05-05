$(function(){
    //se carga el autocompleta del contratista
     $("#txtPersona").autocomplete({
        source:'../../busqueda/persona.B.php',
        select:function(event, ui){
            $("#hidIdPersona").val(ui.item.id);
        }
     }); 
});

// Para consultar combox
// $.post('../../busqueda/persona.B.php', {accion: 'MOSTRAR'}, function (respuesta) {
//     let datos = JSON.parse(respuesta);
//     datos.forEach(dato => {
//         option = document.createElement("option");
//         option.value = dato[1];  
//         option.setAttribute('data-index-number',dato[0]);
//         document.getElementById('roles').append(option); 
//     });
// })

function Enviar(accion, id) {
    if (id === null) {
        id = $('#hidIdUsuario').val();
    }
    var parametros = {
        "id": id,
        "usuario": $('#txtUsuario').val(),
        "contrasenia": $('#passContrasenia').val(),
        "fechaActivacion": $('#datFechaActivacion').val(),
        "fechaExpiracion": $('#datFechaExpiracion').val(),
        "idPersona": $('#hidIdPersona').val(),
        "estado": $('#cmbEstado').val(),
        "accion": accion
    };

    $.ajax({
        data: parametros, //datos que se van a enviar al ajax
        url: '../../controlador/seguridad/usuario.C.php', //archivo php que recibe los datos
        type: 'post', //método para enviar los datos
        dataType: 'json', //Recibe el array desde php

        success: function(respuesta) { //procesa y devuelve la respuesta
            //console.log(respuesta)

            //respuesta adicionar
            if(respuesta['accion']=='ADICIONAR'){
                alert(respuesta['respuesta']);
            }

            //Respuesta muchos registros
            if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] > 1) {
                $("#resultado").html(respuesta['tablaRegistro']);
                //$('#divEliminar').html(respuesta['eliminar']).hide();
            }

            //Respuesta un registro
            if (respuesta['accion'] == 'CONSULTAR') {
                $('#hidIdUsuario').val(respuesta['id']);
                $('#txtUsuario').val(respuesta['usuario']);
                $('#passContrasenia').val(respuesta['contrasenia']);
                $('#fechaActivacion').val(respuesta['fechaActivacion']);
                $('#datFechaExpiracion').val(respuesta['datFechaExpiracion']);
                $('#hidIdPersona').val(respuesta['idPersona']);
                $('#cmbEstado').html(respuesta['estado']);
                $('#divEliminar').html(respuesta['eliminar']);
            }

            //Respuesta modificar
            if (respuesta['accion'] == 'MODIFICAR') {
                alert(respuesta['respuesta']);
            }

            //Respuesta eliminar
            if (respuesta['accion'] == 'ELIMINAR') {
                alert(respuesta['respuesta']);
            }
        }
    });
}
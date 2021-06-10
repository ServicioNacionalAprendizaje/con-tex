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

            //Reiniciar datatable
            $("#tableDatos").dataTable().fnDestroy();

                //Respueta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                }

            //Respuesta muchos registros
            if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                $("#resultado").html(respuesta['tablaRegistro']);
                
                //Código para DataTable

            //Para inicializar datatable de la manera más simple

            $(document).ready(function() {    
                $('#tableDatos').DataTable({
                //para cambiar el lenguaje a español
                    "language": {
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "zeroRecords": "No se encontraron resultados",
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sSearch": "Buscar:",
                            "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                            },
                            "sProcessing":"Procesando...",
                        },
                        "paging":   false
                });     
            });
                //$('#divEliminar').html(respuesta['eliminar']).hide();
            }

            //Respuesta un registro
            if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] == 1) {
                $('#hidIdUsuario').val(respuesta['id']);
                $('#txtUsuario').val(respuesta['usuario']);
                $('#passContrasenia').val(respuesta['contrasenia']);
                $('#datFechaActivacion').val(respuesta['fechaActivacion']);
                $('#datFechaExpiracion').val(respuesta['fechaExpiracion']);
                $('#hidIdPersona').val(respuesta['idPersona']);
                $('#txtPersona').val(respuesta['persona']);
                $('#cmbEstado').val(respuesta['estado']);
                $('#divEliminar').html(respuesta['eliminar']);
                $('#txtUsario').focus();
            }

            //Respuesta modificar
            if (respuesta['accion'] == 'MODIFICAR') {
                alert(respuesta['respuesta']);
                Limpiar();
                $("#btnBuscar").trigger("click");
            }

            //Respuesta eliminar
            if (respuesta['accion'] == 'ELIMINAR') {
                alert(respuesta['respuesta']);
                Limpiar();
                $("#btnBuscar").trigger("click");
            }
        }
    });
}

$(function(){
    //se carga el autocompleta del contratista
     $("#txtPersona").autocomplete({
        source:'../../busqueda/seguridad/persona.B.php',
        select:function(event, ui){
            $("#hidIdPersona").val(ui.item.id);
        }
     }); 
});

function Limpiar(){
    $('#hidIdUsuario').val("");  
    $('#txtUsuario').val(""); 
    $('#passContrasenia').val("");
    $('#datFechaActivacion').val("");  
    $('#datFechaExpiracion').val(""); 
    $('#hidIdPersona').val("");
    $('#txtPersona').val("");
    $('#cmbEstado').val("");
}
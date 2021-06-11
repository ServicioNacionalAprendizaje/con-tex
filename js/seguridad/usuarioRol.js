
function Enviar(accion,id){
    if(id===null){
        id =  $('#hidIdUsuarioRol').val();
    }
    var parametros = {
        "idUsuarioRol" : id,
        "idRol": $('#hidIdRol').val(),
        "idUsuario": $('#hidIdUsuario').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/usuarioRol.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
           
            success:  function (respuesta) { //procesa y devuelve la respuesta
                // console.log(respuesta); 

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
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdUsuarioRol').val(respuesta['idUsuarioRol']);
                    $('#hidIdUsuario').val(respuesta['idUsuario']);
                    $('#txtUsuario').val(respuesta['nombreUsuario']);
                    $('#hidIdRol').val(respuesta['idRol']);
                    $('#txtRol').val(respuesta['descripcionRol']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#datfechaCreacion').val(respuesta['datfechaCreacion']);
                    $('#datModificacion').val(respuesta['datModificacion']);
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtUsuario').focus();
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
    //se carga el autocompletar
    $("#txtRol").autocomplete({
        source:'../../busqueda/seguridad/rol.B.php',
        select:function(event, ui){
            $("#hidIdRol").val(ui.item.id);
        }
     }); 
});
//
$(function(){
    //se carga el autocompletar
    $("#txtUsuario").autocomplete({
        source:'../../busqueda/seguridad/usuario.B.php',
        select:function(event, ui){
            $("#hidIdUsuario").val(ui.item.id);
        }
     }); 
});

function Limpiar(){
    $('#hidIdUsuarioRol').val("");  
    $('#hidIdRol').val("");
    $('#txtRol').val("");
    $('#hidIdUsuario').val("");
    $('#txtUsuario').val(""); 
    $('#cmbEstado').val("");
}
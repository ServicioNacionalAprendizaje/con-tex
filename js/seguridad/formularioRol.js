function Enviar(accion,id){
    if(id===null){
        id =  $('#hidIdFormularioRol').val();
    }
    var parametros = {
        "idFormularioRol" : id,
        "idRol": $('#hidIdRol').val(),
        "idFormulario": $('#hidIdFormulario').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/formularioRol.C.php', //archivo php que recibe los datos
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
                    $('#hidIdFormularioRol').val(respuesta['idFormularioRol']);
                    $('#hidIdRol').val(respuesta['idRol']);
                    $('#txtRol').val(respuesta['descripcionRol']);
                    $('#hidIdFormulario').val(respuesta['idFormulario']);
                    $('#txtFormulario').val(respuesta['descripcionFormulario']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#datfechaCreacion').val(respuesta['datfechaCreacion']);
                    $('#datModificacion').val(respuesta['datModificacion']);
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtRol').focus();
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
    //se carga el autocompleta d
    $("#txtRol").autocomplete({
        source:'../../busqueda/seguridad/rol.B.php',
        select:function(event, ui){
            $("#hidIdRol").val(ui.item.id);
        }
     }); 
});
//
$(function(){
    //se carga el autocompleta 
    $("#txtFormulario").autocomplete({
        source:'../../busqueda/seguridad/formulario.B.php',
        select:function(event, ui){
            $("#hidIdFormulario").val(ui.item.id);
    //i
        }
     }); 
});

function Limpiar(){
    $('#hidIdFormularioRol').val("");
    $('#hidIdRol').val("");
    $('#txtRol').val("");
    $('#hidIdFormulario').val("");
    $('#txtFormulario').val("");
    $('#cmbEstado').val("");
}
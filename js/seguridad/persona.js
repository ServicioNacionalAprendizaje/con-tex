function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdPersona').val();
    }
    var parametros = {
        "id" : id,
        "nombre":$('#txtNombre').val(),
        "apellido":$('#txtApellido').val(),
        "tipoDocumento":$('#cmbTipoDocumento').val(),
        "documento":$('#numDocumento').val(),
        "edad":$('#numEdad').val(),  
        "genero" :$('#cmbGenero').val(),       
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/persona.C.php', //archivo php que recibe los datos
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
                    $('#hidIdPersona').val(respuesta['id']);
                    $('#txtNombre').val(respuesta['nombre']);
                    $('#txtApellido').val(respuesta['apellido']);
                    $('#cmbTipoDocumento').val(respuesta['tipoDocumento']);
                    $('#numDocumento').val(respuesta['documento']);
                    $('#numEdad').val(respuesta['edad']);
                    $('#cmbGenero').val(respuesta['genero']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtNombre').focus();
                }

                //Respuesta modificar
                if(respuesta['accion']=='MODIFICAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                }
                
                //Respuesta eliminar
                if(respuesta['accion']=='ELIMINAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                }
            }
    });
}
function Limpiar(){
    $('#hidIdPersona').val("");  
    $('#txtNombre').val("");  
    $('#txtApellido').val(""); 
    $('#cmbTipoDocumento').val("");
    $('#numDocumento').val("");     
    $('#numEdad').val("");    
    $('#cmbGenero').val("");
    $('#cmbEstado').val("");
}

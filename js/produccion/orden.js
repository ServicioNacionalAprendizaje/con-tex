function Enviar1(accion,id){
    if(id===null){
        id=$('#hidIdOrden1').val();
    }
    var parametros = {
        "id" : id,
        "idEmpleado":$('#hidIdEmpleado1').val(),
        "nombreEmpleado":$('#txtEmpleado1').val(),
        "idCliente":$('#hidIdCliente1').val(),
        "nombreCliente":$('#txtCliente1').val(),
        "fechaOrden":$('#datFechaOrden1').val(),
        "fechaEntrega":$('#datFechaEntrega1').val(),
        "descripcion":$('#txtDescripcion1').val(),
        "estado":$('#cmbEstado1').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/orden.C.php', //archivo php que recibe los datos
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
                    $("#resultado1").html(respuesta['tablaRegistro']);

                    //Código para DataTable

                    //Para inicializar datatable de la manera más simple

                    $(document).ready(function () {
                        $('#tableDatos1').DataTable({
                        //Para cambiar el lenguaje a español
                        "language": {
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "zeroRecords": "No se encontraron resultados",
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sSearch": "Buscar:",
                            "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                            },
                            "sProcessing": "Procesando...",
                        },
                        "paging": false
                        });
                    });
                    //$('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']==1){
                    $('#hidIdOrden1').val(respuesta['id']);
                    $('#hidIdEmpleado1').val(respuesta['idEmpleado']);
                    $('#hidIdCliente1').val(respuesta['idCliente']);
                    $('#txtEmpleado1').val(respuesta['nombreEmpleado']);
                    $('#txtCliente1').val(respuesta['nombreCliente']);
                    $('#datFechaOrden1').val(respuesta['fechaOrden']);
                    $('#datFechaEntrega1').val(respuesta['fechaEntrega']);
                    $('#txtDescripcion1').val(respuesta['descripcion']);
                    $('#cmbEstado1').val(respuesta['estado']);
                    // $('#txtEmpleado1').focus();
                    // $('#cmbEstado').val(respuesta['estado'] == 'Activo' ? 1 : ('Inactivo' ? 0 : ''));
                    // $('#divEliminar').html(respuesta['eliminar']);
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
$(function(){
    //se carga el autocompleta del contratista
     $("#txtEmpleado1").autocomplete({
        source:'../../busqueda/produccion/empleado.B.php',
        select:function(event, ui){
            $("#hidIdEmpleado1").val(ui.item.id);
        }
     }); 
});
$(function(){
    //se carga el autocompleta del contratista
     $("#txtCliente1").autocomplete({
        source:'../../busqueda/produccion/cliente.B.php',
        select:function(event, ui){
            $("#hidIdCliente1").val(ui.item.id);
        }
     }); 
});
function Limpiar1() {
    document.getElementById('hidIdOrden1').value = '';
    document.getElementById('hidIdEmpleado1').value = '';
    document.getElementById('hidIdCliente1').value = '';
    document.getElementById('txtEmpleado1').value = '';
    document.getElementById('txtCliente1').value = '';
    document.getElementById('datFechaOrden1').value = '';
    document.getElementById('datFechaEntrega1').value = '';
    document.getElementById('txtDescripcion1').value = '';
    document.getElementById('cmbEstado1').value = '';
}
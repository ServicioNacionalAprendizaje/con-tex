function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdDetalleOrden').val();
    }
    var parametros = {
        "id" : id,
        "idOrden":$('#idOrden').val(),
        "hidIdProducto":$('#hidIdProducto').val(),
        "producto":$('#txtProducto').val(),
        "cantidad":$('#numCantidad').val(),
        "valInven":$('#numValorinven').val(),
        "valVenta":$('#numValorventa').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/detalleOrden.C.php', //archivo php que recibe los datos
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
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']==1){
                    $('#hidIdDetalleOrden').val(respuesta['id']);
                    $('#idOrden').val(respuesta['idOrden']);
                    $('#hidIdProducto').val(respuesta['hidIdProducto']);
                    $('#txtProducto').val(respuesta['producto']);
                    $('#numCantidad').val(respuesta['cantidad']);
                    $('#numValorinven').val(respuesta['valInven']);
                    $('#numValorventa').val(respuesta['valVenta']);
                    $('#cmbEstado').val(respuesta['estado']);
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
// $(document).ready(function(){
    $(function(){
    //se carga el autocompleta del contratista
     $("#txtProducto").autocomplete({
        source:'../../busqueda/produccion/producto.B.php',
        appendTo : "#staticBackdrop",
        select:function(event, ui){
            $("#hidIdProducto").val(ui.item.id);
        }
     }); 
});
function Limpiar() {
    document.getElementById('hidIdDetalleOrden').value = '';
    document.getElementById('idOrden').value = '';
    document.getElementById('hidIdProducto').value = '';
    document.getElementById('txtProducto').value = '';
    document.getElementById('numCantidad').value = '';
    document.getElementById('numValorinven').value = '';
    document.getElementById('numValorventa').value = '';
    document.getElementById('cmbEstado').value = '';
}
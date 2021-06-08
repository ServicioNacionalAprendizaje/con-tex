function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdOrden').val();
    }
    var parametros = {
        "id" : id,
        "idOrden":$('#idOrden').val(),
        "hidIdProducto":$('#hidIdProducto').val(),
        "Producto":$('#txtProducto').val(),
        "cantidad":$('#numCantidad').val(),
        "valInven":$('#numValorinven').val(),
        "ValVenta":$('#numValorventa').val(),
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
                
                //Respueta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                }
                
                // //Respuesta muchos registros
                // if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                //     $("#resultado").html(respuesta['tablaRegistro']);
                //     //$('#divEliminar').html(respuesta['eliminar']).hide();
                // }

                // //Respuesta un registro
                // if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']==1){
                //     $('#hidIdOrden').val(respuesta['id']);
                //     $('#hidIdEmpleado').val(respuesta['idEmpleado']);
                //     $('#hidIdCliente').val(respuesta['idCliente']);
                //     $('#txtEmpleado').val(respuesta['nombreEmpleado']);
                //     $('#txtCliente').val(respuesta['nombreCliente']);
                //     $('#datFechaOrden').val(respuesta['fechaOrden']);
                //     $('#datFechaEntrega').val(respuesta['fechaEntrega']);
                //     $('#txtDescripcion').val(respuesta['descripcion']);
                //     $('#cmbEstado').val(respuesta['estado']);
                //     // $('#cmbEstado').val(respuesta['estado'] == 'Activo' ? 1 : ('Inactivo' ? 0 : ''));
                //     $('#divEliminar').html(respuesta['eliminar']);
                // }

                // //Respuesta modificar
                // if(respuesta['accion']=='MODIFICAR'){
                //     alert(respuesta['respuesta']);
                //     Limpiar();
                // }
                
                // //Respuesta eliminar
                // if(respuesta['accion']=='ELIMINAR'){
                //     alert(respuesta['respuesta']);
                // }
            }
    });
}
$(function(){
    //se carga el autocompleta del contratista
     $("#txtProducto").autocomplete({
        source:'../../busqueda/produccion/producto.B.php',
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
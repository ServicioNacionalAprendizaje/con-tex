function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdOrden').val();
    }
    var parametros = {
        "id" : id,
        "idEmpleado":$('#hidIdEmpleado').val(),
        "nombreEmpleado":$('#txtEmpleado').val(),
        "idCliente":$('#hidIdCliente').val(),
        "nombreCliente":$('#txtCliente').val(),
        "fechaOrden":$('#datFechaOrden').val(),
        "fechaEntrega":$('#datFechaEntrega').val(),
        "descripcion":$('#txtDescripcion').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/orden.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
           
            success:  function (respuesta) { //procesa y devuelve la respuesta
                // console.log(respuesta); 
                
                //Respueta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                }
                
                //Respuesta muchos registros
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                    $("#resultado").html(respuesta['tablaRegistro']);
                    //$('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']==1){
                    $('#hidIdOrden').val(respuesta['id']);
                    $('#hidIdEmpleado').val(respuesta['idEmpleado']);
                    $('#hidIdCliente').val(respuesta['idCliente']);
                    $('#txtEmpleado').val(respuesta['nombreEmpleado']);
                    $('#txtCliente').val(respuesta['nombreCliente']);
                    $('#datFechaOrden').val(respuesta['fechaOrden']);
                    $('#datFechaEntrega').val(respuesta['fechaEntrega']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
                    $('#cmbEstado').val(respuesta['estado']);
                    // $('#cmbEstado').val(respuesta['estado'] == 'Activo' ? 1 : ('Inactivo' ? 0 : ''));
                    $('#divEliminar').html(respuesta['eliminar']);
                }

                //Respuesta modificar
                if(respuesta['accion']=='MODIFICAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                }
                
                //Respuesta eliminar
                if(respuesta['accion']=='ELIMINAR'){
                    alert(respuesta['respuesta']);
                }
            }
    });
}
$(function(){
    //se carga el autocompleta
     $("#txtEmpleado").autocomplete({
        source:'../../busqueda/produccion/empleado.B.php',
        select:function(event, ui){
            $("#hidIdEmpleado").val(ui.item.id);
        }
     }); 
});

$(function(){
    //se carga el autocompleta del cargo
     $("#txtCliente").autocomplete({
        source:'../../busqueda/produccion/cliente.B.php',
        select:function(event, ui){
            $("#hidIdCliente").val(ui.item.id);
        }
     }); 
});

function Limpiar() {
    document.getElementById('hidIdOrden').value = '';
    document.getElementById('hidIdEmpleado').value = '';
    document.getElementById('hidIdCliente').value = '';
    document.getElementById('txtEmpleado').value = '';
    document.getElementById('txtCliente').value = '';
    document.getElementById('datFechaOrden').value = '';
    document.getElementById('datFechaEntrega').value = '';
    document.getElementById('txtDescripcion').value = '';
    document.getElementById('cmbEstado').value = '';
}
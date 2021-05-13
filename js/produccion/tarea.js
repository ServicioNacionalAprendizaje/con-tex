function Enviar(accion,id){
    if(id===null){
id=$('#hidIdTarea').val();
    }
    var parametros = {
        "id" : id,
        "idEmpleado":$('#hidIdEmpleado').val(),
        "valorUnitario":$('#numValorUnitario').val(),   
        "fecha":$('#datFecha').val(), 
        "cantidad":$('#numCantidad').val(), 
        "estadoPago":$('#txtEstadoPago').val(), 
        "descripcion":$('#txtDescripcion').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 
    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/tarea.C.php', //archivo php que recibe los datos
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
                    $('#hidIdEmpleado').val(respuesta['id']);
                    $('#txtEmpleado').val(respuesta['empleado'])
                    $('#numValorUnitario').val(respuesta['valorUnitario']);
                    $('#datFecha').val(respuesta['fecha']);
                    $('#numCantidad').val(respuesta['cantidad']);
                    $('#txtEstadoPago').val(respuesta['estadoPago']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
                    $('#cmbEstado').val(respuesta['estado']);
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
        source:'../../busqueda/persona.B.php',
        select:function(event, ui){
            $("#hidIdEmpleado").val(ui.item.id);
        }
     }); 
});


function Limpiar(){
    $('#hidIdEmpleado').val("");  
    $('#txtEmpleado').val("");  
    $('#numValorUnitario').val("");      
    $('#datFecha').val("");    
    $('#numCantidad').val("");
    $('#txtEstadoPago').val("");
    $('#txtDescripcion').val("");    
    $('#cmbEstado').val("");
}
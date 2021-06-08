function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdPagoDia').val();
    }
    var parametros = {
        "idPagoDia" : id,
        "idEmpleado" : $('#hidIdEmpleado').val(),
        "pagoDia" : $('#numPagoDia').val(),
        "fechaPago" : $('#datFechaPago').val(),       
        "estado" : $('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/nomina/pagoDia.C.php', //archivo php que recibe los datos
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
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdPagoDia').val(respuesta['idPagoDia']);
                    $('#hidIdEmpleado').val(respuesta['idEmpleado']);
                    $('#txtEmpleado').val(respuesta['nombre']);
                    $('#numPagoDia').val(respuesta['pagoDia']);
                    $('#datFechaPago').val(respuesta['fechaPago']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtEmpleado').focus();
                }

                //Respuesta modificar
                if(respuesta['accion']=='MODIFICAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                }
                
                //Respuesta eliminar
                if(respuesta['accion']=='ELIMINAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                }
            }
    });
}

function Limpiar(){
    $('#hidIdPagoDia').val("");
    $('#hidIdEmpleado').val("");
    $('#txtEmpleado').val("");   
    $('#numPagoDia').val("");  
    $('#datFechaPago').val("");
    $('#cmbEstado').val(""); 
}

$(function(){
    //se carga el autocompleta
     $("#txtEmpleado").autocomplete({
        source:'../../busqueda/nomina/empleadoPagoDia.B.php',
        select:function(event, ui){
            $("#hidIdEmpleado").val(ui.item.id);
        }
     });
});

// $(function(){
//     $("#numPagoDia").on({
//         "focus": function (event) {
//             $(event.target).select();
//         },
//         "keyup": function (event) {
//             $(event.target).val(function (index, value ) {
//                 return value.replace(/\D/g, "")
//                             .replace(/([0-9])([0-9]{2})$/, '$1.$2')
//                             .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
//             });
//         }
//     });
// });

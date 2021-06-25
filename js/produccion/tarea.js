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
      "estadoPago":$('#cmbEstadoPago').val(), 
      "descripcion":$('#txtDescripcion').val(),
      "estado":$('#cmbEstado').val(),
      "accion" : accion
  }; 
  $.ajax({
          data: parametros, //datos que se van a enviar al ajax
          url: '../../controlador/produccion/tarea.C.php', //archivo php que recibe los datos
          type: 'post', //método para enviar los datos
          dataType: 'json',//Recibe el array desde php
          
          success: function (respuesta) { //procesa y devuelve la respuesta
              // console.log(respuesta);

              //Reiniciar datatable
              $("#tableDatos").dataTable().fnDestroy();
      
              //Respueta adicionar
              if (respuesta['accion'] == 'ADICIONAR') {
                alert(respuesta['respuesta']);
                Limpiar();
                $("#btnBuscar").trigger("click");
              }
      
              //Respuesta muchos registros
              if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] > 1) {
                $("#resultado").html(respuesta['tablaRegistro']);
      
                //Código para DataTable
      
                //Para inicializar datatable de la manera más simple
      
                $(document).ready(function () {
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
                  $('#hidIdTarea').val(respuesta['id']);                  
                  $('#hidIdEmpleado').val(respuesta['idEmpleado']);                    
                  $('#txtEmpleado').val(respuesta['empleado']);
                  $('#numValorUnitario').val(respuesta['valorUnitario']);
                  $('#datFecha').val(respuesta['fecha']);
                  $('#numCantidad').val(respuesta['cantidad']);
                  $('#cmbEstadoPago').val(respuesta['estadoPago']);
                  $('#txtDescripcion').val(respuesta['descripcion']);
                  $('#cmbEstado').val(respuesta['estado']);
                  $('#divEliminar').html(respuesta['eliminar']);
                  $('#txtEmpleado').focus();
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
     $("#txtEmpleado").autocomplete({
        source:'../../busqueda/empleado.B.php',
        select:function(event, ui){
            $("#hidIdEmpleado").val(ui.item.id);
        }
     }); 
});


function Limpiar(){
    $('#hidIdTarea').val(""); 
    $('#hidIdEmpleado').val("");  
    $('#txtEmpleado').val("");  
    $('#numValorUnitario').val("");      
    $('#datFecha').val("");    
    $('#numCantidad').val("");
    $('#cmbEstadoPago').val("");
    $('#txtDescripcion').val("");    
    $('#cmbEstado').val("");
}
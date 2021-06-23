function Enviar(accion, id) {
  if (id === null) {
    id = $('#hidIdCategoria').val();
  }
  var parametros = {
    "id": id,
    "descripcion": $('#txtDescripcion').val(),
    "estado": $('#cmbEstado').val(),
    "accion": accion
  };

  $.ajax({
        data: parametros, //datos que se van a enviar al ajax
        url: '../../controlador/produccion/categoria.C.php', //archivo php que recibe los datos
        type: 'post', //método para enviar los datos
        dataType: 'json',//Recibe el array desde php

        success: function (respuesta) { //procesa y devuelve la respuesta
        // console.log(respuesta); 

        //Reiniciar datatable
        $("#tableDatos").dataTable().fnDestroy();

        //Respueta adicionar
        if (respuesta['accion'] == 'ADICIONAR') {
          Swal.fire(
            'Registro con exito',
            'Click en ok para continuar',
            'success'
          )
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
        }

        //Respuesta un registro
        if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] == 1) {
          $('#hidIdCategoria').val(respuesta['id']);
          $('#txtDescripcion').val(respuesta['descripcion']);
          $('#cmbEstado').val(respuesta['estado']);
          $('#divEliminar').html(respuesta['eliminar']);
          $('#txtDescripcion').focus();
        }
      }
    });
}
function modificar(accion,id){

  if (id === null) {
    id = $('#hidIdCategoria').val();
  }
  var parametros = {
    "id": id,
    "descripcion": $('#txtDescripcion').val(),
    "estado": $('#cmbEstado').val(),
    "accion": accion
  };
      Swal.fire({
        title: '¿Quieres guardar los cambios?',
        showDenyButton: true,
        // showCancelButton: true,
        confirmButtonText: `Guardar`,
        denyButtonText: `No guardar`,
      }).then((result) => {
        /* Actuliza los datos */
        if (result.isConfirmed) {
          $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/categoria.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
        
            success: function (respuesta) { //procesa y devuelve la respuesta
              $("#resultado").html(respuesta['tablaRegistro']);
            }
          });
          modificar('MODIFICAR',id)
          Swal.fire('Registro actualizado', '', 'success')
          Limpiar();          
          $("#btnBuscar").trigger("click");
        }else if (result.isDenied) {
          Swal.fire('Acción cancelada', '', 'info')
          Limpiar(); 
          $("#btnBuscar").trigger("click");
        }
      });
}

function eliminar(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
  
  swalWithBootstrapButtons.fire({
    title: '¿Quieres eliminar este archivo?',
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, bórralo',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      Enviar("ELIMINAR",id)
      // Elimina registro
      swalWithBootstrapButtons.fire(
        'Eliminado',
        'Tu archivo ha sido eliminado.',
        'success'
      )
      Limpiar();
      $("#btnBuscar").trigger("click");
    } else if (
      /* Cancela la acción */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        'Tu archivo está seguro',
        'error'
      )
      Limpiar();
    }
  })
}
function Limpiar() {
  $('#hidIdCategoria').val("");
  $('#txtDescripcion').val("");
  $('#cmbEstado').val("");
}
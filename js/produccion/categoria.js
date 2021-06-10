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
      if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] == 1) {
        $('#hidIdCategoria').val(respuesta['id']);
        $('#txtDescripcion').val(respuesta['descripcion']);
        $('#cmbEstado').val(respuesta['estado']);
        $('#divEliminar').html(respuesta['eliminar']);
        $('#txtDescripcion').focus();
      }

      //Respuesta modificar
      if (respuesta['accion'] == 'MODIFICAR') {
        Swal.fire({
          title: '¿Quieres guardar los cambios?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Guardar`,
          denyButtonText: `No guardar`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Registro actualizado', '', 'success')
          } else if (result.isDenied) {
            Swal.fire('Los cambios no se guardaran', '', 'info')
          }
        })
        Limpiar();
        $("#btnBuscar").trigger("click");
      }

      //Respuesta eliminar
      if (respuesta['accion'] == 'ELIMINAR') {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: '¡Estas seguro!',
          text: "¡No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: '¡Sí, bórralo!',
          cancelButtonText: '¡No, cancela!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
              'Registro Eliminado',
              'Su archivo ha sido eliminado.',
              'success'
            )
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'Su archivo ha sido salvado',
              'error'
            )
          }
        })
        Limpiar();
        $("#btnBuscar").trigger("click");
      }
    }
  });

}
function Limpiar() {
  $('#hidIdCategoria').val("");
  $('#txtDescripcion').val("");
  $('#cmbEstado').val("");
}
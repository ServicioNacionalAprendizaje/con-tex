function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdCategoria').val();
    }
    var parametros = {
        "id" : id,
        "descripcion":$('#txtDescripcion').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/categoria.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
           
            success:  function (respuesta) { //procesa y devuelve la respuesta
                // console.log(respuesta); 

                //Reiniciar datatable
                $("#tableDatos").dataTable().fnDestroy();
                
                //Respueta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    Swal.fire(
                        'Resgitro con exito',
                        'Clik en ok para continuar',
                        'success'
                      )
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
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros'] == 1){
                    $('#hidIdCategoria').val(respuesta['id']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtDescripcion').focus();
                }

                //Respuesta modificar
                if(respuesta['accion']=='MODIFICAR'){
                    Swal.fire({
                        title: 'Do you want to save the changes?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: `Save`,
                        denyButtonText: `Don't save`,
                      }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                          Swal.fire('Saved!', '', 'success')
                        } else if (result.isDenied) {
                          Swal.fire('Changes are not saved', '', 'info')
                        }
                      })
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                }
                
                //Respuesta eliminar
                if(respuesta['accion']=='ELIMINAR'){
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                          confirmButton: 'btn btn-success',
                          cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                      })
                      
                      swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                      }).then((result) => {
                        if (result.isConfirmed) {
                          swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )
                        } else if (
                          /* Read more about handling dismissals below */
                          result.dismiss === Swal.DismissReason.cancel
                        ) {
                          swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
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
function Limpiar(){
    $('#hidIdCategoria').val("");  
    $('#txtDescripcion').val(""); 
    $('#cmbEstado').val("");
}
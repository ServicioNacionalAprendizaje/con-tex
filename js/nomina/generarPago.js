function Enviar(accion, id) {
    if (id === null) {
        id = $('#hidIdGenerarPago').val();
    }
    var parametros = {
        "id": id,
        "idEmpleado": $('#hidIdEmpleado').val(),
        "empleado": $('#txtEmpleado').val(),
        "fechaInicio": $('#datFechaInicio').val(),
        "fechaFin": $('#datFechaFin').val(),
        "fechaPago": $('#datFechaPago').val(),
        "valorPago": $('#numValorPago').val(),
        "accion": accion
    };

    $.ajax({
        data: parametros, //datos que se van a enviar al ajax
        url: '../../controlador/nomina/generarPago.C.php', //archivo php que recibe los datos
        type: 'post', //método para enviar los datos
        dataType: 'json', //Recibe el array desde php

        success: function(respuesta) { //procesa y devuelve la respuesta
            // console.log(respuesta); 
            if (respuesta['accion'] == 'GENERAR'){
                $('#numValorPago').val(respuesta['valorPago']);       
            }

            //Respueta adicionar
            if (respuesta['accion'] == 'ADICIONAR') {
                alert(respuesta['respuesta']);
                Limpiar();
            }

            //Respuesta muchos registros
            if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] > 1) {
                $("#resultado").html(respuesta['tablaRegistro']);

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
            if (respuesta['accion'] == 'CONSULTAR') {
                $('#hidIdGenerarPago').val(respuesta['id']);
                $('#hidIdEmpleado').val(respuesta['idEmpleado']);
                $('#txtEmpleado').val(respuesta['empleado']);
                $('#datFechaInicio').val(respuesta['fechaInicio']);
                $('#datFechaFin').val(respuesta['fechaFin']);
                $('#datFechaPago').val(respuesta['fechaPago']);
                $('#numValorPago').val(respuesta['valorPago']);
                $('#divEliminar').html(respuesta['eliminar']);
                $('#txtEmpleado').focus();
            }

            //Respuesta modificar
            if (respuesta['accion'] == 'MODIFICAR') {
                alert(respuesta['respuesta']);
                Limpiar();
            }

            //Respuesta eliminar
            if (respuesta['accion'] == 'ELIMINAR') {
                alert(respuesta['respuesta']);
                Limpiar();
            }
        }
    });
}

function Limpiar() {
    $('#hidIdGenerarPago').val("");
    $('#hidIdEmpleado').val("");
    $('#txtEmpleado').val("");
    $('#datFechaInicio').val("");
    $('#datFechaFin').val("");
    $('#numValorPago').val("");
    $('#datFechaPago').val("");
}
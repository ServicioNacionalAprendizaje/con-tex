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
        "valorPago": $('#numValorPago').val(),
        "fechaPago": $('#datFechaPago').val(),
        "accion": accion
    };

    $.ajax({
        data: parametros, //datos que se van a enviar al ajax
        url: '../../controlador/nomina/generarPago.C.php', //archivo php que recibe los datos
        type: 'post', //método para enviar los datos
        dataType: 'json', //Recibe el array desde php

        success: function(respuesta) { //procesa y devuelve la respuesta
            // console.log(respuesta); 

            //Respueta adicionar
            if (respuesta['accion'] == 'ADICIONAR') {
                alert(respuesta['respuesta']);
                Limpiar();
            }

            //Respuesta muchos registros
            if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] > 1) {
                $("#resultado").html(respuesta['tablaRegistro']);
                //$('#divEliminar').html(respuesta['eliminar']).hide();
            }

            //Respuesta un registro
            if (respuesta['accion'] == 'CONSULTAR') {
                $('#hidIdEmpleado').val(respuesta['id']);
                $('#numCodigo').val(respuesta['codigoCargo']);
                $('#txtEmpleado').val(respuesta['empleado']);
                $('#datFechaInicio').val(respuesta['fechaInicio']);
                $('#datFechaFin').val(respuesta['fechaFin']);
                $('#numValorPago').val(respuesta['valorPago']);
                $('#datFechaPago').val(respuesta['fechaPago']);
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
    $('#hidIdEmpleado').val("");
    $('#txtEmpleado').val("");
    $('#datFechaInicio').val("");
    $('#datFechaFin').val("");
    $('#numValorPago').val("");
    $('#datFechaPago').val("");
}
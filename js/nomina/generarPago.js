function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdCargo').val();
    }
    var parametros = {
        "id" : id,
        "codigoCargo":$('#numCodigo').val(),
        "descripcion":$('#txtDescripcion').val(),       
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/nomina/cargo.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
           
            success:  function (respuesta) { //procesa y devuelve la respuesta
                // console.log(respuesta); 
                
                //Respueta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    alert(respuesta['respuesta']);
                }
                
                //Respuesta muchos registros
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                    $("#resultado").html(respuesta['tablaRegistro']);
                    //$('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdCargo').val(respuesta['id']);
                    $('#numCodigo').val(respuesta['codigoCargo']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#divEliminar').html(respuesta['eliminar']);
                }

                //Respuesta modificar
                if(respuesta['accion']=='MODIFICAR'){
                    alert(respuesta['respuesta']);
                }
                
                //Respuesta eliminar
                if(respuesta['accion']=='ELIMINAR'){
                    alert(respuesta['respuesta']);
                }
            }
    });
}

function Limpiar() {
    document.getElementById('numCodigo').value = '';
    document.getElementById('txtDescripcion').value = '';
    document.getElementById('cmbEstado').value = '';
}
function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdCargo').val();
    }
    var parametros = {
        "id" : id,
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
                    Limpiar();
                }
                
                //Respuesta muchos registros
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                    $("#resultado").html(respuesta['tablaRegistro']);
                    //$('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']==1){
                    $('#hidIdCargo').val(respuesta['id']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
                    $('#cmbEstado').val(respuesta['estado']);
                    // $('#cmbEstado').val(respuesta['estado'] == 'Activo' ? 1 : ('Inactivo' ? 0 : ''));
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtDescripcion').focus();
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

function Limpiar() {
    document.getElementById('hidIdCargo').value = '';
    document.getElementById('txtDescripcion').value = '';
    document.getElementById('cmbEstado').value = '';
}
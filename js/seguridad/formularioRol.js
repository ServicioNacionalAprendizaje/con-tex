function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdFormularioRol').val();
    }
    var parametros = {
        "id" : id,
        "idRol": $('#hidIdRol').val(),
        "idFormulario": $('#hidIdFormulario').val(),
        "estado":$('#cmbEstado').val(),
        "fechaCreacion": $('#datFechaCreacion').val(),
        "fechaModificacion": $('#datFechaModificacion').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: 'C:\xampp\htdocs\xampp\con-tex-main\controlador\seguridad\formularioRol.C.php', //archivo php que recibe los datos
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
                  //  $('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdFormularioRol').val(respuesta['id']);
                    $('#hidIdRol').val(respuesta['idRol']);
                    $('#hidIdFormulario').val(respuesta['idFormulario']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#fechaCreacion').val(respuesta['fechaCreacion']);
                    $('#datModificacion').val(respuesta['datModificacion']);
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

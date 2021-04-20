function Enviar(accion,id){
    if(id==null){
        id=$('#hidIdPersona').val();
    }
    var parametros = {
        "id":id,
        "usuario" :$('#txtUsuario').val(),
        "contrasena" : $('#passContrasena').val(),
        "fechaCreacion":$('#datCreacion').val(),
        "fechaModificacion":$('#datModificacion').val(),
        "idPersona":$('#hidIdPersona').val(),
        "estado":$('#cmbEstado').val(),
        "accion":accion
    };

     $.ajax({
            data:  parametros, //datos que se van a enviar al ajax
            url:   '../../controlador/seguridad/usuario.C.php', //archivo php que recibe los datos
            type:  'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
           
            success:  function (respuesta) { //procesa y devuelve la respuesta
                
                //respuesta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    alert(respuesta['respuesta']);
                }
                
                //Respuesta muchos registros
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                    $("#resultado").html(respuesta['tablaRegistro']);
                    $('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdUsuario').val(respuesta['id']);
                    $('#txtUsuario').val(respuesta['usuario']);
                    $('#passContrasena').val(respuesta['contrasena']);
                    $('#datCreacion').val(respuesta['fechaCreacion']);
                    $('#datModificacion').val(respuesta['fechaModificacion']);
                    $('#hidIdPersona').val(respuesta['idPersona']);
                    $('#cmbEstado').html(respuesta['estado']);
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

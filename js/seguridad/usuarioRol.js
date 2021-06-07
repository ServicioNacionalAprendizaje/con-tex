
function Enviar(accion,id){
    if(id===null){
        id =  $('#hidIdUsuarioRol').val();
    }
    var parametros = {
        "idUsuarioRol" : id,
        "idRol": $('#hidIdRol').val(),
        "idUsuario": $('#hidIdUsuario').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/usuarioRol.C.php', //archivo php que recibe los datos
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
                if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] > 1) {
                    $("#resultado").html(respuesta['tablaRegistro']);
                  //$('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdUsuarioRol').val(respuesta['idUsuarioRol']);
                    $('#hidIdUsuario').val(respuesta['idUsuario']);
                    $('#txtUsuario').val(respuesta['nombreUsuario']);
                    $('#hidIdRol').val(respuesta['idRol']);
                    $('#txtRol').val(respuesta['descripcionRol']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#datfechaCreacion').val(respuesta['datfechaCreacion']);
                    $('#datModificacion').val(respuesta['datModificacion']);
                    $('#divEliminar').html(respuesta['eliminar']);
                    $('#txtUsuario').focus();
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

$(function(){
    //se carga el autocompletar
    $("#txtRol").autocomplete({
        source:'../../busqueda/seguridad/rol.B.php',
        select:function(event, ui){
            $("#hidIdRol").val(ui.item.id);
        }
     }); 
});
//
$(function(){
    //se carga el autocompletar
    $("#txtUsuario").autocomplete({
        source:'../../busqueda/seguridad/usuario.B.php',
        select:function(event, ui){
            $("#hidIdUsuario").val(ui.item.id);
        }
     }); 
});

function Limpiar(){
    $('#hidIdUsuarioRol').val("");  
    $('#hidIdRol').val("");
    $('#txtRol').val("");
    $('#hidIdUsuario').val("");
    $('#txtUsuario').val(""); 
    $('#cmbEstado').val("");
}
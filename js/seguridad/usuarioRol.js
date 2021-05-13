
            $(function(){
                //se carga el autocompletar
                $("#txtRol").autocomplete({
                    source:'../../busqueda/rol.B.php',
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
                }
                
                //Respuesta muchos registros
                if (respuesta['accion'] == 'CONSULTAR' && respuesta['numeroRegistros'] > 1) {
                    $("#resultado").html(respuesta['tablaRegistro']);
                  //$('#divEliminar').html(respuesta['eliminar']).hide();
                }

                //Respuesta un registro
                if(respuesta['accion']=='CONSULTAR'){
                    $('#hidIdUsuarioRol').val(respuesta['idUsuarioRol']);
                    $('#txtRol').val(respuesta['idRol']);
                    $('#txtUsuario').val(respuesta['idUsuario']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#datfechaCreacion').val(respuesta['datfechaCreacion']);
                    $('#datModificacion').val(respuesta['datModificacion']);
                    $('#divEliminar').html(respuesta['eliminar']);
                }

                //Respuesta modificar
                if (respuesta['accion'] == 'MODIFICAR') {
                    alert(respuesta['respuesta']);
                }
                
                //Respuesta eliminar
                if (respuesta['accion'] == 'ELIMINAR') {
                    alert(respuesta['respuesta']);
                }
            }
    });
}
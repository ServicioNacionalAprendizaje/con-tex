function Enviar(accion,id){
    if(id===null){
        id =  $('#hidIdFormularioRol').val();
    }
    var parametros = {
        "idFormularioRol" : id,
        "idRol": $('#hidIdRol').val(),
        "idFormulario": $('#hidIdFormulario').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/formularioRol.C.php', //archivo php que recibe los datos
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
                    $('#hidIdFormularioRol').val(respuesta['idFormularioRol']);
                    $('#hidIdRol').val(respuesta['idRol']);
                    $('#txtRol').val(respuesta['descripcionRol']);
                    $('#hidIdFormulario').val(respuesta['idFormulario']);
                    $('#txtFormulario').val(respuesta['descripcionFormulario']);
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

$(function(){
    //se carga el autocompleta d
    $("#txtRol").autocomplete({
        source:'../../busqueda/seguridad/rol.B.php',
        select:function(event, ui){
            $("#hidIdRol").val(ui.item.id);
        }
     }); 
});
//
$(function(){
    //se carga el autocompleta 
    $("#txtFormulario").autocomplete({
        source:'../../busqueda/seguridad/formulario.B.php',
        select:function(event, ui){
            $("#hidIdFormulario").val(ui.item.id);
    //i
        }
     }); 
});
function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdFormulario').val();
    }
    var parametros = {
        "id" : id,
        "descripcion":$('#txtDescripcion').val(),
        "etiqueta":$('#txtEtiqueta').val(),
        "ubicacion":$('#txtUbicacion').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/seguridad/formulario.C.php', //archivo php que recibe los datos
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
                    $('#hidIdFormulario').val(respuesta['id']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
                    $('#txtEtiqueta').val(respuesta['etiqueta']);
                    $('#txtUbicacion').val(respuesta['ubicacion']);
                    $('#cmbEstado').val(respuesta['estado']);
                    $('#divEliminar').html(respuesta['eliminar']);
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

function Limpiar(){
    $('#hidIdFormulario').val("");  
    $('#txtDescripcion').val("");  
    $('#txtEtiqueta').val("");      
    $('#txtUbicacion').val("");
    $('#cmbEstado').val("");
}
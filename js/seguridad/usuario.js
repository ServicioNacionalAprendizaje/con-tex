function Enviar(accion,id){
    if(id==null){
        id=$('#hidIdFuncionario').val();
    }
    var parametros = {
        "idFuncionario" :id,
        "accion" : accion,
        "identificacion": $('#txtIdentificacion').val(),
        "nombres": $('#txtNombres').val(),
        "apellidos": $('#txtApellidos').val(),
        "correo": $('#txtCorreo').val(),
        "cargo": $('#txtCargo').val()
    };

     $.ajax({
            data:  parametros, //datos que se van a enviar al ajax
            url:   '../controlador/funcionario.C.php', //archivo php que recibe los datos
            type:  'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
           
            success:  function (data) { //procesa y devuelve la respuesta
                
                if(data['accion']=='ADICIONAR'){
                    alert(data['respuesta']);
                }
                
                if(data['accion']=='CONSULTAR' && data['numeroRegistros']>1){
                        $("#resultado").html(data['tablaRegistro']);
                }else{
                    $('#hidIdFuncionario').val(data['id']);
                    $('#txtIdentificacion').val(data['identificacion']);
                    $('#txtNombres').val(data['nombres']);
                    $('#txtApellidos').val(data['apellidos']);
                    $('#txtCorreo').val(data['correo']);
                    $('#txtCargo').val(data['cargo']);
                }
                if(data['accion']=='MODIFICAR'){
                    alert(data['respuesta']);
                }
                if(data['accion']=='ELIMINAR'){
                    alert(data['respuesta']);
                }
            }
    });
    
}

function Limpiar(){
    $('#hidIdFuncionario').val("");
    $('#txtIdentificacion').val("");
    $('#txtNombres').val("");
    $('#txtApellidos').val("");
    $('#txtCorreo').val("");
    $('#txtCargo').val("");
}

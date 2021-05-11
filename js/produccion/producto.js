
            $(function(){
                //se carga el autocompleta d
                $("#txtCategoria").autocomplete({
                    source:'../../busqueda/categoria.B.php',
                    select:function(event, ui){
                        $("#hidIdCategoria").val(ui.item.id);
                    }
                 }); 
            });

function Enviar(accion,id){
    if(id===null){
        id=$('#hidIdProduccion').val();
    }
    var parametros = {
        "id" : id,
        "idCategoria":$('#hidIdCategoria').val(),
        "talla":$('#txtTalla').val(),
        "descripcion":$('#txtDescripcion').val(),
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 

    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/produccion/producto.C.php', //archivo php que recibe los datos
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
                    $('#hidIdProducto').val(respuesta['id']);
                    $('#txtCategoria').val(respuesta['categoria']);
                    $('#txtTalla').val(respuesta['talla']);
                    $('#txtDescripcion').val(respuesta['descripcion']);
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

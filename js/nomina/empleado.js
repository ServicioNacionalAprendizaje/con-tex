function Enviar(accion,id){
    if(id===null){
id=$('#hidIdEmpleado').val();
    }
    var parametros = {
        "id" : id,
        "idCargo":$('#hidIdCargo').val(),
        "correoInstitucional":$('#txtCorreoInstitucional').val(),   
        "fechaIngreso":$('#datFechaIngreso').val(), 
        "arl":$('#cmbArl').val(), 
        "salud":$('#cmbSalud').val(), 
        "pension":$('#cmbPension').val(),
        "idPersona":$('#hidIdPersona').val(),  
        "sueldoBasico":$('#numSueldoBasico').val(),   
        "estado":$('#cmbEstado').val(),
        "accion" : accion
    }; 
    $.ajax({
            data: parametros, //datos que se van a enviar al ajax
            url: '../../controlador/nomina/empleado.C.php', //archivo php que recibe los datos
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
                    $('#hidIdEmpleado').val(respuesta['id']);
                    $('#hidIdCargo').val(respuesta['idCargo']);
                    $('#txtCargo').val(respuesta['cargo']);
                    $('#txtCorreoInstitucional').val(respuesta['correoInstitucional']);
                    $('#datFechaIngreso').val(respuesta['fechaIngreso']);
                    $('#cmbArl').val(respuesta['arl']);
                    $('#cmbSalud').val(respuesta['salud']);
                    $('#cmbPension').val(respuesta['pension']);
                    $('#hidIdPersona').val(respuesta['idPersona']);
                    $('#txtPersona').val(respuesta['persona']);
                    $('#numSueldoBasico').val(respuesta['sueldoBasico']);
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
$(function(){
    //se carga el autocompleta
     $("#txtPersona").autocomplete({
        source:'../../busqueda/persona.B.php',
        select:function(event, ui){
            $("#hidIdPersona").val(ui.item.id);
        }
     }); 
});

$(function(){
    //se carga el autocompleta del cargo
     $("#txtCargo").autocomplete({
        source:'../../busqueda/cargo.B.php',
        select:function(event, ui){
            $("#hidIdCargo").val(ui.item.id);
        }
     }); 
}); 

function Limpiar(){
    $('#hidIdEmpleado').val("");  
    $('#hidIdCargo').val("");  
    $('#hidIdPersona').val("");      
    $('#txtCargo').val("");    
    $('#txtCorreoInstitucional').val("");
    $('#datFechaIngreso').val("");
    $('#cmbArl').val("");    
    $('#cmbSalud').val("");
    $('#cmbPension').val("");
    $('#txtPersona').val("");
    $('#numSueldoBasico').val("");
    $('#cmbEstado').val("");
}
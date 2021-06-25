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
                
                //Reiniciar datatable
                $("#tableDatos").dataTable().fnDestroy();

                //Respueta adicionar
                if(respuesta['accion']=='ADICIONAR'){
                    if($("#txtCorreoInstitucional").val().indexOf('@', 0) == -1 || $("#txtCorreoInstitucional").val().indexOf('.', 0) == -1) {
                        alert('El correo electrónico introducido no es correcto.');
                        return false;
                    }
                    alert(respuesta['respuesta']);
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                    }
                
                //Respuesta muchos registros
                if(respuesta['accion']=='CONSULTAR' && respuesta['numeroRegistros']>1){
                    $("#resultado").html(respuesta['tablaRegistro']);
                    
                    //Código para DataTable

                    //Para inicializar datatable de la manera más simple

                    $(document).ready(function() {    
                        $('#tableDatos').DataTable({
                        //para cambiar el lenguaje a español
                            "language": {
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "zeroRecords": "No se encontraron resultados",
                                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "sSearch": "Buscar:",
                                    "oPaginate": {
                                    "sFirst": "Primero",
                                    "sLast":"Último",
                                    "sNext":"Siguiente",
                                    "sPrevious": "Anterior"
                                    },
                                    "sProcessing":"Procesando...",
                                },
                                "paging":   false
                        });     
                    });
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
                    $('#txtCargo').focus();
                }
                //Respuesta modificar
                if(respuesta['accion']=='MODIFICAR'){
                    alert(respuesta['respuesta']);                                       
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                }
                
                //Respuesta eliminar
                if(respuesta['accion']=='ELIMINAR'){
                    alert(respuesta['respuesta']);
                    Limpiar();
                    $("#btnBuscar").trigger("click");
                }
            }
    });
}

$(function(){
    //se carga el autocompleta
     $("#txtPersona").autocomplete({
        source:'../../busqueda/seguridad/persona.B.php',
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
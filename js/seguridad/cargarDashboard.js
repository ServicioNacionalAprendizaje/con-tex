function CargarDashboard(sesion){    
    var parametros = {                
        "sesion" : sesion
    }; 
    $.ajax({   
        data: parametros,     
        url: 'controlador/seguridad/cargarDashboard.C.php', //archivo php que recibe los datos
        type: 'post', //método para enviar los datos
        dataType: 'json',//Recibe el array desde php
        
        success:  function (respuesta) { //procesa y devuelve la respuesta
            console.log(respuesta);                         
            //Respuesta muchos registros
            if( respuesta['numeroRegistros']>=1){
                $("#cargarDashboard").html(respuesta['menu_recursivo']);
                $("#usserLogin").html(respuesta['usser_login']);
            }
            if( respuesta['respuesta']=='cerrar_sesion'){
                window.location =respuesta['ruta'];
            }              
        }
    });
}


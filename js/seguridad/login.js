function Login(e){    
    if (e.keyCode === 13 || e === 'click'){
        var parametros = {        
            "user":$('#txtEmail').val(),
            "password" : $('#txtContrasenia').val()
        }; 

        $.ajax({
            data: parametros, //datos que se van a enviar al ajax   
            url: 'controlador/seguridad/login.C.php', //archivo php que recibe los datos
            type: 'post', //método para enviar los datos
            dataType: 'json',//Recibe el array desde php
            
            success:  function (respuesta) { //procesa y devuelve la respuesta
                console.log(respuesta);                         
                //Respuesta muchos registros
                if( respuesta['estado']==0){
                    window.location =respuesta['respuesta'];
                }else{
                    alert(respuesta['respuesta']);
                    $('#txtEmail').val("");  
                    $('#txtContrasenia').val(""); 
                }              
            }
        });
    }
}


<?php
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formulario.M.php';

// session_start();
// $_SESSION['id_login']
if (isset ( $_SESSION['id_login'])){  
    try{
        $formulario = new Formulario();                
        $formulario->setUbicacion($_SESSION['ruta_formulario']);               
        $formulario->validarFormulario();
        
        if ($rowBuscar = $formulario->conn->ObtenerObjeto()){
            if(intval($rowBuscar->cantidad)!==1)
            {                
                header("Location: ../../");
                session_destroy();
                exit;                
            } 
        }         
    }catch(Exception $e){
        $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";     
        $respuesta['estado']=1;   
    }
    
}else{
    header("Location: ../../");
    exit;
}
?>
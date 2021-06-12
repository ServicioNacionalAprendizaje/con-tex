<?php
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formulario.M.php';

// session_start();
// $_SESSION['id_login']
if (isset ( $_SESSION['id_login'])){  
    try{
        $formulario = new Formulario();                
        $formulario->setUbicacion(basename( __FILE__ ));               
        $formulario->validarFormulario();
        
        if ($rowBuscar = $formulario->conn->ObtenerObjeto()){
            if(intval($rowBuscar->cantidad)===1)
            {
                $_SESSION['autenticado'] = $rowBuscar->cantidad;                
                $respuesta['respuesta']= "dashboard.php";
            } 
        }         
    }catch(Exception $e){
        $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";     
        $respuesta['estado']=1;   
    }
    
}
?>
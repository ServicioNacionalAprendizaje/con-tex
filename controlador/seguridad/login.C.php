<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';

$respuesta = array();
session_start();
if (isset ($_POST['user'])){  
    try{
        $usuario = new Usuario();                
        $usuario->setUsuario($_POST['user']); 
        $usuario->setContrasenia(md5($_POST['password']));        
        $usuario->login();
        
        if ($rowBuscar = $usuario->conn->ObtenerObjeto()){
            if(intval($rowBuscar->autenticado)===1)
            {
                $_SESSION['autenticado'] = $rowBuscar->autenticado;
                $_SESSION['id_login'] = $rowBuscar->id_usuario;
                $_SESSION['login'] = $rowBuscar->usuario;
                $_SESSION['nombre_login'] = $rowBuscar->nombre;
                $respuesta['estado']=0;
                $respuesta['respuesta']= "dashboard.php";
            } else{
                $respuesta['respuesta']='Error en los datos ingresados!!';
                $respuesta['estado']=1;
            }        
        }         
        
    }catch(Exception $e){
        $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";     
        $respuesta['estado']=1;   
    }
    echo json_encode($respuesta);
}
?>
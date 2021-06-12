<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';
require '../../modelo/seguridad/formulario.M.php';

$respuesta = array();
$contador = 0;
session_start();

if (isset ($_SESSION['id_login'])){  
    switch ($_POST['sesion'])
    {
        case "cerrar_sesion":
            session_destroy();
            $respuesta['respuesta']= "cerrar_sesion";
            $respuesta['ruta']= "index.html";
        break;
        case "":
            try{
                $carpeta = new Usuario();                
                $carpeta->setIdUsuario($_SESSION['id_login']);        
                $carpeta->construirCarpeta(); 
        
        
                $retorno="";
                while($rowCarpeta = $carpeta->conn->obtenerObjeto()){                  
                    $retorno .= "<div class='btn-group'>
                            <button type='button' class='btn btn btn-outline-light dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".$rowCarpeta->modulo."</button>
                            <div class='dropdown-menu'>";
        
                    $menu = new Formulario();                
                    $menu->setEtiqueta($rowCarpeta->modulo);        
                    $menu->construirDashboard();
                    while($rowConsulta = $menu->conn->obtenerObjeto()){                    
                        $retorno .= " <a class='dropdown-item' href='".$rowConsulta->ubicacion."' target='container_fluid_iframe'>".$rowConsulta->descripcion."</a><div class='dropdown-divider'></div>";                            
                    }                                      
                    $retorno .= "</div></div>";
                    $contador++;                        
                }     
                $respuesta['usser_login']=$_SESSION['nombre_login'];     
                $respuesta['menu_recursivo']=$retorno;
                $respuesta['numeroRegistros']=$contador;
                
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }
        break; 
    }    
    echo json_encode($respuesta);
}else{
    $respuesta['respuesta']= "cerrar_sesion";
    $respuesta['ruta']= "index.html";
    echo json_encode($respuesta);
}
?>
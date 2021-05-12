<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';
require '../../modelo/seguridad/formulario.M.php';

$respuesta = array();
$contador = 0;
$autenticado = 1;

if (isset ($autenticado)){  
    try{
        $carpeta = new Usuario();                
        $carpeta->setIdUsuario($autenticado);        
        $carpeta->construirCarpeta(); 


        $retorno="";
        while($rowCarpeta = $carpeta->conn->obtenerObjeto()){                  
            $retorno .= "<div class='btn-group'>
                    <button type='button' class='btn btn-success dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".$rowCarpeta->modulo."</button>
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
             
        $respuesta['menu_recursivo']=$retorno;
        $respuesta['numeroRegistros']=$contador;
        
    }catch(Exception $e){
        $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
    }
    echo json_encode($respuesta);
}
?>
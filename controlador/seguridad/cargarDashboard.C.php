<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';

$respuesta = array();
$contador = 0;
$autenticado = 1;

if (isset ($autenticado)){  
    try{
        $usuario = new Usuario();                
        $usuario->setIdUsuario($autenticado);        
        $usuario->construirDashboard();           
      
        $retorno="";
        while($rowConsulta = $usuario->conn->obtenerObjeto()){                    
            $retorno .= "<div class='btn-group'>
                            <button type='button' class='btn btn-success dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".$rowConsulta->etiqueta."</button>
                            <div class='dropdown-menu'>
                                <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='".$rowConsulta->ubicacion."' target='container_fluid_iframe'>".$rowConsulta->descripcion."</a>
                                <div class='dropdown-divider'></div>                        
                            </div>
                        </div>";
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
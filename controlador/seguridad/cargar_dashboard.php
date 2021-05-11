<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';

$respuesta = array();
$usuario = 'admin';
if (isset ($usuario)){  
    try{
        $formulario = new Usiario();                
        $formulario->setIdUsuario($usuario);        
        $resultado = $formulario->construirDashboard();   
        
        
        if($numeroRegistros === 1){
            if ($rowBuscar = $usuario->conn->obtenerObjeto()){
                // pendiente
            }
        }else{
            if(isset($resultado)){
                $retorno="";
                foreach($usuario->conn->ObtenerRegistros()AS $rowConsulta){
                    $retorno .= "                                       
                    <div class='btn-group'>
                        <button type='button' class='btn btn-success dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Seguridad</button>
                        <div class='dropdown-menu'>
                            <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='vista/seguridad/usuario.V.html' target='container_fluid_iframe'>Usuario</a>
                            <div class='dropdown-divider'></div>                        
                        </div>
                    </div>";
                }
                $respuesta['dashboard']=$retorno;
            }else{
                $respuesta['dashboard']='Usuario sin permisos!!';
            }
        }
    }catch(Exception $e){
        $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
    }
    json_encode($respuesta);
}
?>
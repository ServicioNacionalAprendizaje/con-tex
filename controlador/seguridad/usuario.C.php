<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $usuario= new Usuario();
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia($_POST['contrasenia']);
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);
                $usuario->setIdUsuarioCreacion(1);
                $usuario->setIdUsuarioModificacion(1);                
                $resultado = $usuario->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia($_POST['contrasenia']);
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);               
                $resultado = $usuario->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id']);
                $resultado = $usuario->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia($_POST['contrasenia']);
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);
                $resultado = $usuario->consultar();

                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_usuario;
                        $respuesta['usuario'] = $rowBuscar->usuario;
                        $respuesta['contrasenia'] = $rowBuscar->contrasenia;
                        $respuesta['fechaActivacion'] = $rowBuscar->fecha_activacion;
                        $respuesta['fechaExpiracion'] = $rowBuscar->fecha_expiracion;
                        $respuesta['idPersona'] = $rowBuscar->id_persona;
                        $respuesta['estado'] = $rowBuscar->estado == 1 ? 'Activo':'Inactivo';
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_usuario.")'>";
                        
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($usuario->conn->ObtenerRegistros()AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>".$rowConsulta[2]."</label></td>                                        
                                        <td><label>".$rowConsulta[3]."</label></td>                                                                                               
                                        <td><label>".$rowConsulta[4]."</label></td>
                                        <td><label>".($rowConsulta[9]== 1 ? 'Activo':'Inactivo')."</label></td>
                                        <td align='center'><a href='#' class='btn btn-warning'><i class='fas fa-edit' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></i></a></td>
                                        <td align='center'><a href='#' class='btn btn-danger'><i class='fas fa-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></i></a></td>                                                                                
                                        </tr>";
                        }
                        
                        $retorno.="</table>";
                        $respuesta['tablaRegistro']=$retorno;
                    }else{
                    $respuesta['tablaRegistros']='No existen datos!!';
                    }
                }

            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }    
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
        break;
    }
}
?>
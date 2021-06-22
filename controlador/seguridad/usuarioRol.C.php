<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuarioRol.M.php';

$respuesta = array();
$accion = $_POST['accion'];

if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $usuarioRol= new UsuarioRol();
                $usuarioRol->setIdUsuario($_POST['idUsuario']);
                $usuarioRol->setIdRol($_POST['idRol']);
                $usuarioRol->setEstado($_POST['estado']);
                $usuarioRol->setIdUsuarioCreacion();
                $usuarioRol->setIdUsuarioModificacion();
                $resultado = $usuarioRol->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
           echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $usuarioRol= new UsuarioRol();
                $usuarioRol->setIdUsuarioRol($_POST['idUsuarioRol']);
                $usuarioRol->setIdUsuario($_POST['idUsuario']);
                $usuarioRol->setIdRol($_POST['idRol']);
                $usuarioRol->setEstado($_POST['estado']);
                $usuarioRol->setIdUsuarioModificacion();

                $resultado = $usuarioRol->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
           echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $usuarioRol = new UsuarioRol();
                $usuarioRol->setIdUsuarioRol($_POST['idUsuarioRol']);
                $resultado = $usuarioRol->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $usuarioRol = new UsuarioRol();
                $usuarioRol->setIdUsuarioRol($_POST['idUsuarioRol']);
                $usuarioRol->setIdUsuario($_POST['idUsuario']);
                $usuarioRol->setIdRol($_POST['idRol']);
                $usuarioRol->setEstado($_POST['estado']);
                // $formularioRol->setFechaCreacion($_POST['fechaCreacion']);
                // $formularioRol->setFechaModificacion($_POST['fechaModificacion']);
                //$formularioRol->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                //$formularioRol->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $usuarioRol->consultar();

                $numeroRegistros = $usuarioRol->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $usuarioRol->conn->obtenerObjeto()){
                        $respuesta['idUsuarioRol'] = $rowBuscar->id_usuario_rol;
                        $respuesta['idUsuario'] = $rowBuscar->id_usuario;
                        $respuesta['nombreUsuario'] = $rowBuscar->nombre_usuario;
                        $respuesta['idRol'] = $rowBuscar->id_rol;
                        $respuesta['descripcionRol'] = $rowBuscar->descripcion_rol;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['fechaCreacion'] = $rowBuscar->fecha_creacion;
                        $respuesta['fechaModificacion'] = $rowBuscar->fecha_modificacion;
                        $respuesta['idUsuarioCreacion'] = $rowBuscar->id_usuario_creacion;
                        $respuesta['idUsuarioModificacion'] = $rowBuscar->id_usuario_modificacion;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_usuario_rol.")'>";
                    }
               }else{
                        if(isset($resultado)){
                            $retorno="<table>";
                            foreach($usuarioRol->conn->ObtenerRegistros()AS $rowConsulta){
                                $retorno .= "<tr>                                          
                                            <td><label>".$rowConsulta[2]."</label></td>
                                            <td><label>".$rowConsulta[4]."</label></td>                                             
                                            <td><label>".$rowConsulta[6]."</label></td>                                        
                                            <td><label>".$rowConsulta[7]."</label></td>
                                            <td><label>".($rowConsulta[5]== 1 ? 'Activo':'Inactivo')."</label></td>
                                            <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                            <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                                                                 
                                            </tr>";
                            }

                            $retorno.="</table>";
                            $respuesta['tablaRegistro']=$retorno;
                        }else{
                        $respuesta['tablaRegistro']='No existen datos!!';
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
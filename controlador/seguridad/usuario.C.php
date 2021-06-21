<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';
require '../../modelo/seguridad/enviarCorreo.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset($accion)) {
    switch ($accion) {
        case 'ADICIONAR':
            try {
                $usuario= new Usuario();
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia(md5($_POST['contrasenia']));
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);
                $usuario->setIdUsuarioCreacion(1);
                $usuario->setIdUsuarioModificacion(1);
                $resultado = $usuario->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR';
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia(md5($_POST['contrasenia']));
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);
                $usuario->setIdUsuarioModificacion(1);
                $resultado = $usuario->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente.";
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id']);
                $resultado = $usuario->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['id']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia($_POST['contrasenia']);
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $resultado = $usuario->Consultar();

                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if ($numeroRegistros === 1) {
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()) {
                        $respuesta['id'] = $rowBuscar->id_usuario;
                        $respuesta['usuario'] = $rowBuscar->usuario;
                        $respuesta['contrasenia'] = $rowBuscar->contrasenia;
                        $respuesta['fechaActivacion'] = $rowBuscar->fecha_activacion;
                        $respuesta['fechaExpiracion'] = $rowBuscar->fecha_expiracion;
                        $respuesta['idPersona'] = $rowBuscar->id_persona;
                        $respuesta['persona'] = $rowBuscar->nombre;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_usuario.")'>";
                    }
                } else {
                    if (isset($resultado)) {
                        $retorno="<table>";
                        foreach ($usuario->conn->ObtenerRegistros()as $rowConsulta) {
                            $retorno .= "<tr>
                                        <td><label>".$rowConsulta[7]."</label></td>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                        
                                        <td><label>".$rowConsulta[3]."</label></td>                                                                                               
                                        <td><label>".$rowConsulta[4]."</label></td>
                                        <td><label>".($rowConsulta[5]== 1 ? 'Activo':'Inactivo')."</label></td>
                                        <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                        <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                                                                
                                        </tr>";
                        }
                        
                        $retorno.="</table>";
                        $respuesta['tablaRegistro']=$retorno;
                    } else {
                        $respuesta['tablaRegistros']='No existen datos!!';
                    }
                }
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
        break;
        case 'RESTAURAR':
            try {
                $usuario = new Usuario();
                $usuario->setUsuario($_POST['usuario']);
                $resultado = $usuario->Consultar();
                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if ($numeroRegistros === 1) {
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()) {
                        $nuevaClave=rand(1000, 9999);
                        $usuario->setIdUsuario($rowBuscar->id_usuario);
                        $usuario->setContrasenia(md5($nuevaClave));
                        $usuario->setIdUsuarioModificacion($rowBuscar->id_usuario);
                        $resultado = $usuario->Restablecer();

                        // Enviar correo
                        $correo = new enviarCorreo();
                        $correo->setCorreo($_POST['usuario']);
                        $correo->setContrasenia($nuevaClave);
                        $resultado = $correo->EnviarCorreo();
                    }
                    $respuesta['respuesta']="Se restableció la contraseña correctamente.";
                }
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fue posible restaurar la contraseña, consulte con el administrador.";
            }
            $respuesta['accion']='RESTAURAR';
            $respuesta['ruta'] = 'index.html';
            echo json_encode($respuesta);
        break;
    }
}

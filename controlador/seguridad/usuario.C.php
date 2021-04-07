<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';

$respuesta = array();

$accion = 'ADICIONAR';
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $usuario= new Usuario();
                $usuario->setUsuario('admin');
                $usuario->setContrasenia('abcd1234');
                $usuario->setFechaActivacion('CURDATE()');
                $usuario->setFechaExpiracion('CURDATE()');
                $usuario->setidPersona(1);
                $usuario->setEstado(1);
                $resultado = $usuario->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia($_POST['contrasenia']);
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);               
                $usuario->setFechaModificacion($_POST['fechaModificacion']);
                $usuario->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);

                $resultado = $usuario->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                $resultado = $usuario->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setContrasenia($_POST['contrasenia']);
                $usuario->setFechaActivacion($_POST['fechaActivacion']);
                $usuario->setFechaExpiracion($_POST['fechaExpiracion']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setEstado($_POST['estado']);
                $usuario->setFechaCreacion($_POST['fechaCreacion']);
                $usuario->setFechaModificacion($_POST['fechaModificacion']);
                $usuario->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                $usuario->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $usuario->consultar();

                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()){
                        $_POST['idUsuario'] = $rowBuscar->id_usuario;
                        $_POST['usuario'] = $rowBuscar->usuario;
                        $_POST['contrasenia'] = $rowBuscar->contrasena;
                        $_POST['fechaActivacion'] = $rowBuscar->fecha_activacion;
                        $_POST['fechaExpiracion'] = $rowBuscar->fecha_expiracion;
                        $_POST['idPersona'] = $rowBuscar->id_persona;
                        $_POST['estado'] = $rowBuscar->estado;
                        $_POST['fechaCreacion'] = $rowBuscar->fecha_creacion;
                        $_POST['fechaModificacion'] = $rowBuscar->fecha_modificacion;
                        $_POST['idUsuarioCreacion'] = $rowBuscar->id_usuario_creacion;
                        $_POST['idUsuarioModificacion'] = $rowBuscar->id_usuario_modificacion;
                    }
                }
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
    }
}
?>
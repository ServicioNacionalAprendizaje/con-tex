<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formularioRol.M.php';

$respuesta = array();
// $_POST['accion'] --- $accion
$accion = 'ADICIONAR';
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $formularioRol= new FormularioRol();
                $formularioRol->setIdFormularioRol('12345');
                $formularioRol->setIdRol('12345');
                $formularioRol->setEstado(1);
                $resultado = $usuario->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $formularioRol= new FormularioRol();
                $formularioRol->setIdFormularioRol($_POST['idFormularioRol']);
                $formularioRol->setIdRol($_POST['idRol']);
                $formularioRol->setIdFormulario($_POST['idFormulario']);
                $formularioRol->setEstado($_POST['estado']);               
                $formularioRol->setFechaModificacion($_POST['fechaModificacion']);
                $formularioRol->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);

                $resultado = $usuario->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $formularioRol = new Usuario();
                $formularioRol->setIdFormularioRol($_POST['idFormularioRol']);
                $resultado = $formularioRol->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $formularioRol = new FormularioRol();
                $formularioRol->setIdFormularioRol($_POST['idFormularioRol']);
                $formularioRol->setIdRol($_POST['idRol']);
                $formularioRol->setIdFormulariol($_POST['idFormulario']);
                $formularioRol->setEstado($_POST['estado']);
                $formularioRol->setFechaCreacion($_POST['fechaCreacion']);
                $formularioRol->setFechaModificacion($_POST['fechaModificacion']);
                //$formularioRol->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                //$formularioRol->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $formularioRol->consultar();

                $numeroRegistros = $formularioRol->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $formularioRol->conn->obtenerObjeto()){
                        $_POST['idFormularioRol'] = $rowBuscar->id_formulario_rol;
                        $_POST['idRolol'] = $rowBuscar->id_rol;
                        $_POST['idFormulario'] = $rowBuscar->id_formulario;
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
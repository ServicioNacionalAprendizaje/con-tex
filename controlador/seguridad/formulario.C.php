<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formulario.M.php';

$respuesta = array();
// $_POST['accion'] --- $accion
$accion = 'ADICIONAR';
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $formulario = new Formulario();
                $formulario->setIdFormulario('321');
                $formulario->setDescripcion('abcd1234');
                $formulario->setEtiqueta('abc123');
                $formulario->setUbicacion('abc123');
                $formulario->setEstado(1);
                $resultado = $formulario->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $formulario = new Formulario();
                $formulario->setIdFormulario($_POST['idUsuario']);
                $formulario->setDescripcion($_POST['usuario']);
                $formulario->setEtiqueta($_POST['contrasenia']);
                $formulario->setUbicacion($_POST['fechaActivacion']);
                $formulario->setEstado($_POST['estado']);               
                $formulario->setFechaModificacion($_POST['fechaModificacion']);
                $formulario->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);

                $resultado = $formulario->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $formulario = new Usuario();
                $formulario->setIdFormulario($_POST['idFormulario']);
                $resultado = $formulario->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $formulario = new Formulario();
                $formulario->setIdFormulario($_POST['idUsuario']);
                $formulario->setEtiqueta($_POST['usuario']);
                $formulario->setUbicado($_POST['contrasenia']);
                $formulario->setEstado($_POST['estado']);
                $formulario->setFechaCreacion($_POST['fechaCreacion']);
                $formulario->setFechaModificacion($_POST['fechaModificacion']);
                $formulario->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                $formulario->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $formulario->consultar();

                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()){
                        $_POST['idFormulario'] = $rowBuscar->id_formulario;
                        $_POST['descripcion'] = $rowBuscar->descripcion;
                        $_POST['etiqueta'] = $rowBuscar->etiqueta;
                        $_POST['ubicacion'] = $rowBuscar->ubicacion;
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
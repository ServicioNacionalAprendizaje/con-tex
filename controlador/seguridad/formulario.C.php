<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formulario.M.php';

$respuesta = array();
// $_POST['accion'] --- $accion
$accion = 'accion';
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $formulario = new Formulario();
                $formulario->setDescripcion($_POST['descripcion']);
                $formulario->setEtiqueta($_POST['etiqueta']);
                $formulario->setUbicacion($_POST['ubicacion']);
                $formulario->setEstado($_POST['estado']);
                $resultado = $formulario->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR';
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $formulario = new Formulario();
                $formulario->setIdFormulario($_POST['id']);
                $formulario->setDescripcion($_POST['descripcion']);
                $formulario->setEtiqueta($_POST['etiqueta']);
                $formulario->setUbicacion($_POST['ubicacion']);
                $formulario->setEstado($_POST['estado']);

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
                $formulario->setIdFormulario($_POST['id']);
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
                $formulario->setIdFormulario($_POST['id']);
                $formulario->setDescripcion($_POST['descripcion']);
                $formulario->setEtiqueta($_POST['etiqueta']);
                $formulario->setUbicacion($_POST['ubicacion']);
                $formulario->setEstado($_POST['estado']);
                $resultado = $formulario->consultar();

                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()){
                        $_POST['idFormulario'] = $rowBuscar->id_formulario;
                        $_POST['descripcion'] = $rowBuscar->descripcion;
                        $_POST['etiqueta'] = $rowBuscar->etiqueta;
                        $_POST['ubicacion'] = $rowBuscar->ubicacion;
                        $_POST['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_formulario.")'>";
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
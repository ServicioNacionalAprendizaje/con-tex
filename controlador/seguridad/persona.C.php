<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/persona.M.php';

$respuesta = array();
// $_POST['accion'] --- $accion
$accion = 'ADICIONAR';
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $persona= new Persona();
                $persona->setIdPersona('12345');
                $persona->setNombre('abcd');
                $persona->setApellido('abcd');
                $persona->setEdad('26');
                $persona->setGenero('M');
                $persona->setEstado(1);
                $resultado = $persona->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $persona = new Persona();
                $persona->setIdPersona($_POST['idPersona']);
                $persona->setNombre($_POST['nombre']);
                $persona->setApellido($_POST['apellido']);
                $persona->setEdad($_POST['edad']);
                $persona->setGenero($_POST['genero']);
                $persona->setEstado($_POST['estado']);
                $persona->setFechaCreacion($_POST['fechaCreacion']);
                $persona->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                $persona->setIdUsuarioModificacion($_POST['idUsuarioModiificacion']);

                $resultado = $usuario->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $persona = new Usuario();
                $persona->setIdPersona($_POST['idPersona']);
                $resultado = $persona->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $persona = new Persona();
                $persona->setIdPersona($_POST['idPersona']);
                $persona->setNombre($_POST['nombre']);
                $persona->setApellido($_POST['apellido']);
                $persona->setEdad($_POST['edad']);
                $persona->setGenero($_POST['genero']);
                $persona->setEstado($_POST['fechaCreacion']);
                $persona->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                $persona->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $persona->consultar();

                $numeroRegistros = $persona->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $persona->conn->obtenerObjeto()){
                        $_POST['idPersona'] = $rowBuscar->id_persona;
                        $_POST['nombre'] = $rowBuscar->nombre;
                        $_POST['apellido'] = $rowBuscar->apellido;
                        $_POST['edad'] = $rowBuscar->edad;
                        $_POST['genero'] = $rowBuscar->genero;
                        $_POST['estado'] = $rowBuscar->estado;
                        $_POST['fechaCreacion'] = $rowBuscar->fecha_creacion;
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
<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/rol.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $rol= new Rol();
                $rol->setDescripcion($_POST['descripcion']);
                $rol->setEstado($_POST['estado']);
                $rol = $rol->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR';
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $rol = new Rol();
                $rol->setIdRol($_POST['idRol']);
                $rol->setDescripcion($_POST['descripcion']);
                $rol->setEstado($_POST['estado']);               
                $rol->setFechaModificacion($_POST['fechaModificacion']);
                $rol->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);

                $resultado = $rol->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $rol = new Rol();
                $rol->setIdRol($_POST['idRol']);
                $rol = $usuario->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $rol = new Rol();
                $rol->setIdRol($_POST['idRol']);
                $rol->setDescripcion($_POST['descripcion']);
                $rol->setEstado($_POST['estado']);
                $rol->setFechaCreacion($_POST['fechaCreacion']);
                $rol->setFechaModificacion($_POST['fechaModificacion']);
                $rol->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                $usurolario->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $rol->consultar();

                $numeroRegistros = $rol->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $rol->conn->obtenerObjeto()){
                        $respuesta['idRol'] = $rowBuscar->id_rol;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['fechaCreacion'] = $rowBuscar->fecha_creacion;
                        $respuesta['fechaModificacion'] = $rowBuscar->fecha_modificacion;
                        $respuesta['idUsuarioCreacion'] = $rowBuscar->id_usuario_creacion;
                        $respuesta['idUsuarioModificacion'] = $rowBuscar->id_usuario_modificacion;
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($persona->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>
                                        <td><label>".$rowConsulta[0]."</label></td>     
                                        <td><label>".$rowConsulta[1]."</label></td>                                            
                                        <td>
                                            <input type='button' name='editar' value='Editar' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'>
                                            <input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'>
                                        </td>
                                    </tr>";
                        }  
                        $retorno .= "</table>";
                        $respuesta['tablaRegistro']=$retorno;
                    }else{
                        $respuesta['tablaRegistro']='No existen datos!!!';
                    }
                }
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }
            $respuesta['accion']='CONSULTAR'; 
            echo json_encode($respuesta);
        break;
    }
}
?>
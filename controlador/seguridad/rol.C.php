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
                $rol = new Rol();
                $rol->setDescripcion($_POST['descripcion']);
                $rol->setEstado($_POST['estado']);
                $rol->setIdUsuarioCreacion(1);
                $rol->setIdUsuarioModificacion(1);
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
                $rol->setIdRol($_POST['id']);
                $rol->setDescripcion($_POST['descripcion']);
                $rol->setEstado($_POST['estado']);
                $resultado = $rol->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $rol = new Rol();
                $rol->setIdRol($_POST['id']);
                $rol = $rol->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $rol = new Rol();
                $rol->setIdRol($_POST['id']);
                $rol->setDescripcion($_POST['descripcion']);
                $rol->setEstado($_POST['estado']);
                $resultado = $rol->Consultar();

                $numeroRegistros = $rol->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $rol->conn->obtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_rol;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['estado'] = $rowBuscar->estado == 1 ? 'Activo':'Inactivo';
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_rol.")'>";
                     }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($rol->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>
                                        <td><label>".$rowConsulta[1]."</label></td>     
                                        <td><label>".($rowConsulta[2] == 1 ? 'Activo' : 'Inactivo')."</label></td>                                           
                                        <td align='center'><a href='#' class='btn btn-warning'><i class='fas fa-edit' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></i></a></td>
                                        <td align='center'><a href='#' class='btn btn-danger'><i class='fas fa-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></i></a></td>
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
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
        break;
    }
}
?>
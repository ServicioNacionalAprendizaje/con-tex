<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formularioRol.M.php';

$respuesta = array();

$accion = $_POST['accion'];

if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $formularioRol= new FormularioRol();
                $formularioRol->setIdRol($_POST['idRol']);
                $formularioRol->setIdFormulario($_POST['idFormulario']);
                $formularioRol->setEstado($_POST['estado']);
                $formularioRol->setIdUsuarioCreacion(1);
                $formularioRol->setIdUsuarioModificacion(1);
                $resultado = $formularioRol->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
           echo json_encode($respuesta);
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

                $resultado = $formularioRol->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
           echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $formularioRol = new FormularioRol();
                $formularioRol->setIdFormularioRol($_POST['idFormularioRol']);
                $resultado = $formularioRol->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $formularioRol = new FormularioRol();
                $formularioRol->setIdFormularioRol($_POST['idFormularioRol']);
                $formularioRol->setIdRol($_POST['idRol']);
                $formularioRol->setIdFormulario($_POST['idFormulario']);
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
               }else{
                        if(isset($resultado)){
                            $retorno="<table>";
                            foreach($usuario->conn->ObtenerRegistros()AS $rowConsulta){
                                $retorno .= "<tr>                                          
                                            <td><label>".$rowConsulta[0]."</label></td>                                             
                                            <td><label>".$rowConsulta[4]."</label></td>                                        
                                            <td><label>".$rowConsulta[5]."</label></td>                                                                                               

                                            <td><label>".($rowConsulta[3]== 1 ? 'Activo':'Inactivo')."</label></td>
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
            json_encode($respuesta);
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
            break;
    }
}
?>
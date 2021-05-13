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
                $formularioRol->setIdUsuarioModificacion();

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
                $respuesta['respuesta']="La información se eliminó correctamente.";
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
                // $formularioRol->setFechaCreacion($_POST['fechaCreacion']);
                // $formularioRol->setFechaModificacion($_POST['fechaModificacion']);
                //$formularioRol->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                //$formularioRol->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $formularioRol->consultar();

                $numeroRegistros = $formularioRol->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $formularioRol->conn->obtenerObjeto()){
                        $respuesta['idFormularioRol'] = $rowBuscar->id_formulario_rol;
                        $respuesta['idRol'] = $rowBuscar->id_rol;
                        $respuesta['idFormulario'] = $rowBuscar->id_formulario;
                        $respuesta['estado'] = $rowBuscar->estado == 1 ? 'Activo':'Inactivo';
                        $respuesta['fechaCreacion'] = $rowBuscar->fecha_creacion;
                        $respuesta['fechaModificacion'] = $rowBuscar->fecha_modificacion;
                        $respuesta['idUsuarioCreacion'] = $rowBuscar->id_usuario_creacion;
                        $respuesta['idUsuarioModificacion'] = $rowBuscar->id_usuario_modificacion;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_formulario_rol.")'>";
                    }
               }else{
                        if(isset($resultado)){
                            $retorno="<table>";
                            foreach($formularioRol->conn->ObtenerRegistros()AS $rowConsulta){
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
                        $respuesta['tablaRegistro']='No existen datos!!';
                        }
                }
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }
            // json_encode($respuesta);
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
            break;
    }
}
?>
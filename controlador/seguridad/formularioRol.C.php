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
                        $respuesta['descripcionRol'] = $rowBuscar->descripcion_rol;
                        $respuesta['idFormulario'] = $rowBuscar->id_formulario;
                        $respuesta['descripcionFormulario'] = $rowBuscar->descripcion_formulario;
                        $respuesta['estado'] = $rowBuscar->estado;
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
                                            <td><label>".$rowConsulta[2]."</label></td>
                                            <td><label>".$rowConsulta[4]."</label></td>                                             
                                            <td><label>".$rowConsulta[6]."</label></td>                                        
                                            <td><label>".$rowConsulta[7]."</label></td>                                                                                               
                                            <td><label>".($rowConsulta[5]== 1 ? 'Activo':'Inactivo')."</label></td>
                                            <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                            <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                                                                
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
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
            break;
    }
}
?>
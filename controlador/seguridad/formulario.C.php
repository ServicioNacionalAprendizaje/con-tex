<?php
//$ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/formulario.M.php';

$respuesta = array();

$accion = $_POST['accion'];

if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $formulario = new Formulario();
                $formulario->setDescripcion($_POST['descripcion']);
                $formulario->setEtiqueta($_POST['etiqueta']);
                $formulario->setUbicacion($_POST['ubicacion']);
                $formulario->setEstado($_POST['estado']);
                $formulario->setIdUsuarioCreacion(1);
                $formulario->setIdUsuarioModificacion(1);
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
                $formulario->setIdFormulario($_POST['idFormulario']);
                $formulario->setDescripcion($_POST['descripcion']);
                $formulario->setEtiqueta($_POST['etiqueta']);
                $formulario->setUbicacion($_POST['ubicacion']);
                $formulario->setEstado($_POST['estado']);               
                $formulario->setIdUsuarioModificacion(1);

                $resultado = $formulario->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $formulario = new Formulario();
                $formulario->setIdFormulario($_POST['idFormulario']);
                $resultado = $formulario->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $formulario = new Formulario();
                $formulario->setIdFormulario($_POST['idFormulario']);
                $formulario->setDescripcion($_POST['descripcion']);
                $formulario->setEtiqueta($_POST['etiqueta']);
                $formulario->setUbicacion($_POST['ubicacion']);
                $formulario->setEstado($_POST['estado']);
                // $formulario->setFechaCreacion($_POST['fechaCreacion']);
                // $formulario->setFechaModificacion($_POST['fechaModificacion']);
                // $formulario->setIdUsuarioCreacion($_POST['idUsuarioCreacion']);
                // $formulario->setIdUsuarioModificacion($_POST['idUsuarioModificacion']);
                $resultado = $formulario->Consultar();

                $numeroRegistros = $formulario->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $formulario->conn->obtenerObjeto()){
                        $respuesta['idFormulario'] = $rowBuscar->id_formulario;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['etiqueta'] = $rowBuscar->etiqueta;
                        $respuesta['ubicacion'] = $rowBuscar->ubicacion;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['fechaCreacion'] = $rowBuscar->fecha_creacion;
                        $respuesta['fechaModificacion'] = $rowBuscar->fecha_modificacion;
                        $respuesta['idUsuarioCreacion'] = $rowBuscar->id_usuario_creacion;
                        $respuesta['idUsuarioModificacion'] = $rowBuscar->id_usuario_modificacion;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_formulario.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($formulario->conn->ObtenerRegistros()AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>".$rowConsulta[2]."</label></td>                                        
                                        <td><label>".$rowConsulta[3]."</label></td>
                                        <td><label>".($rowConsulta[4]== 1 ? 'Activo':'Inactivo')."</label></td>
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
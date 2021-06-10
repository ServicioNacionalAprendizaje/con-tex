<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/nomina/pagoDia.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $pagoDia= new pagoDia();
                $pagoDia->setIdPagoDia($_POST['idPagoDia']);
                $pagoDia->setIdEmpleado($_POST['idEmpleado']);
                $pagoDia->setPagoDia($_POST['pagoDia']);
                $pagoDia->setFechaPago($_POST['fechaPago']);
                $pagoDia->setEstado($_POST['estado']);
                $pagoDia->setIdUsuarioCreacion(); // Obtener id del cargo con la variable session
                $pagoDia->setIdUsuarioModificacion(); // Obtener id del cargo con la variable session
                
                $resultado = $pagoDia->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $pagoDia = new pagoDia();
                $pagoDia->setIdPagoDia($_POST['idPagoDia']);
                $pagoDia->setIdEmpleado($_POST['idEmpleado']);
                $pagoDia->setPagoDia($_POST['pagoDia']);
                $pagoDia->setFechaPago($_POST['fechaPago']);
                $pagoDia->setEstado($_POST['estado']);
                $pagoDia->setIdUsuarioModificacion();

                $resultado = $pagoDia->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $pagoDia = new pagoDia();
                $pagoDia->setIdPagoDia($_POST['idPagoDia']);
                $resultado = $pagoDia->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $pagoDia = new pagoDia();
                $pagoDia->setIdPagoDia($_POST['idPagoDia']);
                $pagoDia->setIdEmpleado($_POST['idEmpleado']);
                $pagoDia->setPagoDia($_POST['pagoDia']);
                $pagoDia->setFechaPago($_POST['fechaPago']);
                $pagoDia->setEstado($_POST['estado']);
                $resultado = $pagoDia->consultar();

                $numeroRegistros = $pagoDia->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $pagoDia->conn->ObtenerObjeto()){
                        $respuesta['idPagoDia'] = $rowBuscar->id_pago_dia;
                        $respuesta['idEmpleado'] = $rowBuscar->id_empleado;
                        $respuesta['nombre'] = $rowBuscar->nombre;
                        $respuesta['pagoDia'] = $rowBuscar->pago_dia;
                        $respuesta['fechaPago'] = $rowBuscar->fecha_pago_dia;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_pago_dia.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($pagoDia->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>$".$rowConsulta[2]."</label></td>
                                        <td><label>".$rowConsulta[3]."</label></td>                                        
                                        <td><label>".($rowConsulta[4]== 1 ? 'Pagado':'Sin pagar')."</label></td>                                                                                              
                                        <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                        <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                        
                                        </tr>";
                        }  
                            //     <td>
                            //     <input type='button' name='editar' value='Editar' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'>
                            //     <input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'>
                            // </td>
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
<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/produccion/orden.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $orden= new Orden();
                $orden->setIdEmpleado($_POST['idEmpleado']);
                $orden->setIdCliente($_POST['idCliente']);
                $orden->setFechaOrden($_POST['fechaOrden']);
                $orden->setFechaEntrega($_POST['fechaEntrega']);
                $orden->setDescripcion($_POST['descripcion']);
                $orden->setEstado($_POST['estado']);
                $orden->setIdUsuarioCreacion(1); // Obtener id del orden con la variable session
                $orden->setIdUsuarioModificacion(1); // Obtener id del orden con la variable session
                $resultado = $orden->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $orden = new Orden();
                $orden->setIdOrden($_POST['id']);
                $orden->setIdEmpleado($_POST['idEmpleado']);
                $orden->setIdCliente($_POST['idCliente']);
                $orden->setFechaOrden($_POST['fechaOrden']);
                $orden->setFechaEntrega($_POST['fechaEntrega']);
                $orden->setDescripcion($_POST['descripcion']);
                $orden->setEstado($_POST['estado']);
                $orden->setIdUsuarioModificacion(2);
                $resultado = $orden->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente, para refrescar la tabla busque nuevamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $orden = new Orden();
                $orden->setIdOrden($_POST['id']);
                $resultado = $orden->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente, para refrescar la tabla busque nuevamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $orden = new Orden();
                $orden->setIdOrden($_POST['id']);
                $orden->setIdEmpleado($_POST['idEmpleado']);
                $orden->setIdCliente($_POST['idCliente']);
                $orden->setFechaOrden($_POST['fechaOrden']);
                $orden->setFechaEntrega($_POST['fechaEntrega']);
                $orden->setDescripcion($_POST['descripcion']);
                $orden->setEstado($_POST['estado']);
                $resultado = $orden->Consultar();
                $numeroRegistros = $orden->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $orden->conn->ObtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_orden;
                        $respuesta['idEmpleado'] = $rowBuscar->id_empleado;
                        $respuesta['nombreEmpleado'] = $rowBuscar->nombreEmpleado;
                        $respuesta['idCliente'] = $rowBuscar->id_cliente;
                        $respuesta['nombreCliente'] = $rowBuscar->nombreCliente;
                        $respuesta['fechaOrden'] = date("Y-m-d", strtotime($rowBuscar->fecha_orden)).'T'.date("H:i", strtotime($rowBuscar->fecha_orden));
                        $respuesta['fechaEntrega'] = date("Y-m-d", strtotime($rowBuscar->fecha_entrega)).'T'.date("H:i", strtotime($rowBuscar->fecha_entrega));
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar1(\"ELIMINAR\",".$rowBuscar->id_orden.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($orden->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>
                                        <td><label>".$rowConsulta[0]."</label></td>                                          
                                        <td><label>".$rowConsulta[7]."</label></td>
                                        <td><label>".$rowConsulta[8]."</label></td>
                                        <td><label>".$rowConsulta[3]."</label></td>
                                        <td><label>".$rowConsulta[4]."</label></td>
                                        <td><label>".$rowConsulta[5]."</label></td>
                                        <td><label>".($rowConsulta[6]== 1 ? 'Activo':'Inactivo')."</label></td>
                                        <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar1(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                        <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='Enviar1(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                         
                                       
                                    </tr>";
                        }  
                            //     <td>
                            //     <input type='button' name='editar' value='Editar' onclick='Enviar1(\"CONSULTAR\",".$rowConsulta[0].")'>
                            //     <input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar1(\"ELIMINAR\",".$rowConsulta[0].")'>
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
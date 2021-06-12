<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/produccion/detalleOrden.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $detalleOrden= new DetalleOrden();
                $detalleOrden->setValorInventario($_POST['valInven']);
                $detalleOrden->setValorVenta($_POST['valVenta']);
                $detalleOrden->setCantidad($_POST['cantidad']);
                $detalleOrden->setIdOrden($_POST['idOrden']);
                $detalleOrden->setIdProducto($_POST['hidIdProducto']);
                $detalleOrden->setEstado($_POST['estado']);
                $detalleOrden->setIdUsuarioCreacion(1); // Obtener id del orden con la variable session
                $detalleOrden->setIdUsuarioModificacion(1); // Obtener id del orden con la variable session
                $resultado = $detalleOrden->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $detalleOrden = new DetalleOrden();
                $detalleOrden->setIdDetalleOrden($_POST['id']);
                $detalleOrden->setValorInventario($_POST['valInven']);
                $detalleOrden->setValorVenta($_POST['valVenta']);
                $detalleOrden->setCantidad($_POST['cantidad']);
                $detalleOrden->setIdOrden($_POST['idOrden']);
                $detalleOrden->setIdProducto($_POST['hidIdProducto']);
                $detalleOrden->setEstado($_POST['estado']);
                $detalleOrden->setIdUsuarioModificacion(2);
                $resultado = $detalleOrden->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente, para refrescar la tabla busque nuevamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $detalleOrden = new DetalleOrden();
                $detalleOrden->setIdDetalleOrden($_POST['id']);
                $resultado = $detalleOrden->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente, para refrescar la tabla busque nuevamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $detalleOrden = new DetalleOrden();
                $detalleOrden->setIdDetalleOrden($_POST['id']);
                $detalleOrden->setValorInventario($_POST['valInven']);
                $detalleOrden->setValorVenta($_POST['valVenta']);
                $detalleOrden->setCantidad($_POST['cantidad']);
                $detalleOrden->setIdOrden($_POST['idOrden']);
                $detalleOrden->setIdProducto($_POST['hidIdProducto']);
                $detalleOrden->setEstado($_POST['estado']);
                $resultado = $detalleOrden->consultar();
                $numeroRegistros = $detalleOrden->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $detalleOrden->conn->ObtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_detalle_orden;
                        $respuesta['idOrden'] = $rowBuscar->id_orden;
                        $respuesta['hidIdProducto'] = $rowBuscar->id_producto;
                        $respuesta['producto'] = $rowBuscar->nombre_producto;
                        $respuesta['cantidad'] = $rowBuscar->cantidad;
                        $respuesta['valInven'] = $rowBuscar->valor_inventario;
                        $respuesta['valVenta'] = $rowBuscar->valor_venta;
                        $respuesta['estado'] = $rowBuscar->estado;
                        // $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_orden.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($detalleOrden->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[4]."</label></td>
                                        <td><label>".$rowConsulta[7]."</label></td>
                                        <td><label>".$rowConsulta[3]."</label></td>
                                        <td><label>".$rowConsulta[1]."</label></td>
                                        <td><label>".$rowConsulta[2]."</label></td>
                                        <td><label>".($rowConsulta[6]== 1 ? 'Activo':'Inactivo')."</label></td>
                                        <td align='center'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                        <td align='center'><span class='icon-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                         
                                       
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
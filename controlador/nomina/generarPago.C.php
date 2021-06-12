<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/nomina/generarPago.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $generarPago = new GenerarPago();
                $generarPago->setIdGenerarPago($_POST['id']);
                $generarPago->setIdEmpleado($_POST['idEmpleado']);
                $generarPago->setFechaInicio($_POST['fechaInicio']);
                $generarPago->setFechaFin($_POST['fechaFin']);
                $generarPago->setValorPago($_POST['valorPago']);
                $generarPago->setFechaPago($_POST['fechaPago']);
                $generarPago->setIdUsuarioCreacion(1); // Obtener id del cargo con la variable session
                $generarPago->setIdUsuarioModificacion(1); // Obtener id del cargo con la variable session
                $resultado = $generarPago->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $generarPago = new GenerarPago();
                $generarPago->setIdGenerarPago($_POST['id']);
                $generarPago->setIdEmpleado($_POST['idEmpleado']);
                $generarPago->setFechaInicio($_POST['fechaInicio']);
                $generarPago->setFechaFin($_POST['fechaFin']);
                $generarPago->setValorPago($_POST['valorPago']);
                $generarPago->setFechaPago($_POST['fechaPago']);

                $resultado = $generarPago->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $generarPago = new GenerarPago();
                $generarPago->setIdGenerarPago($_POST['id']);
                $resultado = $generarPago->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $generarPago = new GenerarPago();
                $generarPago->setIdGenerarPago($_POST['id']);
                $generarPago->setIdEmpleado($_POST['idEmpleado']);
                $generarPago->setFechaInicio($_POST['fechaInicio']);
                $generarPago->setFechaFin($_POST['fechaFin']);
                $generarPago->setValorPago($_POST['valorPago']);
                $generarPago->setFechaPago($_POST['fechaPago']);                           
                $resultado = $generarPago->consultar();

                $numeroRegistros = $generarPago->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $generarPago->conn->ObtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_generar_pago;
                        $respuesta['empleado'] = $rowBuscar->empleado;
                        $respuesta['fechaInicio'] = $rowBuscar->fecha_inicio;
                        $respuesta['fechaFin'] = $rowBuscar->fecha_fin;
                        $respuesta['valorPago'] = $rowBuscar->valor_pago;
                        $respuesta['fechaPago'] = $rowBuscar->fecha_pago;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_cargo.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($generarPago->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>".$rowConsulta[2]."</label></td>                                        
                                        <td><label>".($rowConsulta[3]== 1 ? 'Activo':'Inactivo')."</label></td>                                                                                              
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
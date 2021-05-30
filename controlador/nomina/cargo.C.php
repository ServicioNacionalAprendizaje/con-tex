<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/nomina/cargo.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $cargo= new Cargo();
                $cargo->setDescripcion($_POST['descripcion']);
                $cargo->setEstado($_POST['estado']);
                $cargo->setIdUsuarioCreacion(1); // Obtener id del cargo con la variable session
                $cargo->setIdUsuarioModificacion(1); // Obtener id del cargo con la variable session
                $resultado = $cargo->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $cargo = new Cargo();
                $cargo->setIdCargo($_POST['id']);
                $cargo->setDescripcion($_POST['descripcion']);
                $cargo->setEstado($_POST['estado']);
                $cargo->setIdUsuarioModificacion(2);
                $resultado = $cargo->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente, para refrescar la tabla busque nuevamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $cargo = new Cargo();
                $cargo->setIdCargo($_POST['id']);
                $resultado = $cargo->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente, para refrescar la tabla busque nuevamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $cargo = new Cargo();
                $cargo->setIdCargo($_POST['id']);
                $cargo->setDescripcion($_POST['descripcion']);
                $cargo->setEstado($_POST['estado']); 
                $resultado = $cargo->consultar();
                $numeroRegistros = $cargo->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $cargo->conn->ObtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_cargo;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_cargo.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($cargo->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                            <td><label>".$rowConsulta[1]."</label></td>
                                            <td><label>".($rowConsulta[2]== 1 ? 'Activo':'Inactivo')."</label></td>
                                            <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                            <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></td>                                        
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
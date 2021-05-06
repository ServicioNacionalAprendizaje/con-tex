<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/nomina/empleado.M.php';
$respuesta = array();
$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $empleado = new Empleado();
                $empleado->setIdCargo($_POST['idCargo']);
                $empleado->setCorreoInstitucional($_POST['correoInstitucional']);
                $empleado->setFechaIngreso($_POST['fechaIngreso']);
                $empleado->setArl($_POST['arl']);
                $empleado->setSalud($_POST['salud']);
                $empleado->setPension($_POST['pension']);
                $empleado->setIdPersona($_POST['idPersona']);
                $empleado->setEstado($_POST['estado']);
                $empleado->setIdUsuarioCreacion(1); // Obtener id de la persona con la variable session
                $empleado->setIdUsuarioModificacion(1); // Obtener id de la persona con la variable session
                $resultado = $empleado->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $empleado = new Empleado();
                $empleado->setIdCargo($_POST['idCargo']);
                $empleado->setCorreoInstitucional($_POST['correoInstitucional']);
                $empleado->setFechaIngreso($_POST['fechaIngreso']);
                $empleado->setArl($_POST['arl']);
                $empleado->setSalud($_POST['salud']);
                $empleado->setPension($_POST['pension']);
                $empleado->setIdPersona($_POST['idPersona']);
                $empleado->setEstado($_POST['estado']);
                $resultado = $empleado->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $empleado = new Empleado();
                $empleado->setIdCargo($_POST['idCargo']);
                $resultado = $empleado->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $empleado = new Empleado();
                $empleado->setIdEmpleado($_POST['id']);
                $empleado->setIdCargo($_POST['idCargo']);
                $empleado->setCorreoInstitucional($_POST['correoInstitucional']);
                $empleado->setFechaIngreso($_POST['fechaIngreso']);
                $empleado->setArl($_POST['arl']);
                $empleado->setSalud($_POST['salud']);   
                $empleado->setPension($_POST['pension']);
                $empleado->setIdPersona($_POST['idPersona']);                           
                $resultado = $empleado->consultar();
                $numeroRegistros = $empleado->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $empleado->conn->ObtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_empleado;
                        $respuesta['idCargo'] = $rowBuscar->id_cargo;
                        $respuesta['correoInstitucional'] = $rowBuscar->correo_institucional;
                        $respuesta['fechaIngreso'] = $rowBuscar->fecha_ingreso;                           
                        $respuesta['arl'] = $rowBuscar->arl;
                        $respuesta['salud'] = $rowBuscar->salud;                           
                        $respuesta['pension'] = $rowBuscar->pension;
                        $respuesta['idPersona'] = $rowBuscar->id_persona;
                        $respuesta['estado'] = $rowBuscar->estado == 1 ? 'Activo':'Inactivo';
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_persona.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($empleado->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>".$rowConsulta[2]."</label></td>                                        
                                        <td><label>".$rowConsulta[3]."</label></td>     
                                        <td><label>".$rowConsulta[4]."</label></td>                                             
                                        <td><label>".$rowConsulta[5]."</label></td>                                        
                                        <td><label>".$rowConsulta[6]."</label></td>
                                        <td><label>".$rowConsulta[7]."</label></td>
                                        <td><label>".($rowConsulta[8]== 1 ? 'Activo' : 'Inactivo')."</label></td>
                                        <td align='center'><a href='#' class='btn btn-warning'><i class='fas fa-edit' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></i></a></td>
                                        <td align='center'><a href='#' class='btn btn-danger'><i class='fas fa-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></i></a></td>                                                                                
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
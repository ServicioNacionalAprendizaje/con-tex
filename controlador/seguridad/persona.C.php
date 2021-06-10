<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/seguridad/persona.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $persona= new Persona();
                $persona->setNombre($_POST['nombre']);
                $persona->setApellido($_POST['apellido']);
                $persona->setTipoDocumento($_POST['tipoDocumento']);
                $persona->setDocumento($_POST['documento']);
                $persona->setEdad($_POST['edad']);
                $persona->setGenero($_POST['genero']);
                $persona->setEstado($_POST['estado']);
                $persona->setIdUsuarioCreacion(1); // Obtener id de la persona con la variable session
                $persona->setIdUsuarioModificacion(1); // Obtener id de la persona con la variable session
                $resultado = $persona->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR'; 
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $persona = new Persona();
                $persona->setIdPersona($_POST['id']);
                $persona->setNombre($_POST['nombre']);
                $persona->setApellido($_POST['apellido']);
                $persona->setTipoDocumento($_POST['tipoDocumento']);
                $persona->setDocumento($_POST['documento']);
                $persona->setEdad($_POST['edad']);
                $persona->setGenero($_POST['genero']);
                $persona->setEstado($_POST['estado']);
                $persona->setIdUsuarioModificacion(1);
                $resultado = $persona->Modificar();
                $respuesta['respuesta']="La información se modificó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $persona = new Persona();
                $persona->setIdPersona($_POST['id']);
                $resultado = $persona->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $persona = new Persona();
                $persona->setIdPersona($_POST['id']);
                $persona->setNombre($_POST['nombre']);
                $persona->setApellido($_POST['apellido']);
                $persona->setTipoDocumento($_POST['tipoDocumento']);
                $persona->setDocumento($_POST['documento']);
                $persona->setEdad($_POST['edad']);
                $persona->setGenero($_POST['genero']);
                $persona->setEstado($_POST['estado']);                              
                $resultado = $persona->consultar();

                $numeroRegistros = $persona->conn->ObtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $persona->conn->ObtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_persona;
                        $respuesta['nombre'] = $rowBuscar->nombre;
                        $respuesta['apellido'] = $rowBuscar->apellido;
                        $respuesta['tipoDocumento'] = $rowBuscar->tipo_documento;
                        $respuesta['documento'] = $rowBuscar->documento;
                        $respuesta['edad'] = $rowBuscar->edad;                           
                        $respuesta['genero'] = $rowBuscar->genero;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_persona.")'>";
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($persona->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>".$rowConsulta[2]."</label></td>  
                                        <td><label>".$rowConsulta[3]."</label></td> 
                                        <td><label>".$rowConsulta[4]."</label></td>                                        
                                        <td><label>".$rowConsulta[5]."</label></td>                                                                                               
                                        <td><label>".($rowConsulta[6]== 'M' ? 'Masculino' : ($rowConsulta[6]== 'F' ? 'Femenino' : 'Otro'))."</label></td>
                                        <td><label>".($rowConsulta[7]== 1 ? 'Activo' : 'Inactivo')."</label></td>
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
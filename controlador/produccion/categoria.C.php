<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/produccion/categoria.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $categoria = new Categoria();
                $categoria->setDescripcion($_POST['descripcion']);
                $categoria->setEstado($_POST['estado']);
                $categoria->setIdUsuarioCreacion(1); // Obtener id de la persona con la variable session
                $categoria->setIdUsuarioModificacion(1); // Obtener id de la persona con la variable session
                $resultado = $categoria->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR';
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $categoria = new Categoria();
                $categoria->setIdCategoria($_POST['id']);
                $categoria->setDescripcion($_POST['descripcion']);
                $categoria->setEstado($_POST['estado']);  
                $categoria->setIdUsuarioModificacion(1);              
                $resultado = $categoria->Modificar();
                $respuesta['respuesta']="La información se actualizó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $categoria = new Categoria();
                $categoria->setIdCategoria($_POST['id']);
                $categoria = $categoria->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $categoria = new Categoria();
                $categoria->setIdCategoria($_POST['id']);
                $categoria->setDescripcion($_POST['descripcion']);
                $resultado = $categoria->Consultar();

                $numeroRegistros = $categoria->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $categoria->conn->obtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_categoria;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_categoria.")'>";
                     }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($categoria->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>
                                        <td><label>".$rowConsulta[1]."</label></td>     
                                        <td><label>".($rowConsulta[2] == 1 ? 'Activo' : 'Inactivo')."</label></td>                                           
                                        <td align='center' style='cursor: pointer'><span class='icon-edit1' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></td>
                                        <td align='center' style='cursor: pointer'><span class='icon-trash' onclick='eliminar($rowConsulta[0])'></td>  
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
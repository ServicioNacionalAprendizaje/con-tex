<?php
// $ubicacionFormulario =  substr($_SERVER["SCRIPT_NAME"], 17);
include '../../entorno/conexion.php';
require '../../modelo/produccion/producto.M.php';

$respuesta = array();

$accion = $_POST['accion'];
if (isset ($accion)){
    switch($accion){
        case 'ADICIONAR':
            try{
                $producto = new Producto();
                $producto->setDescripcion($_POST['descripcion']);
                $producto->setTalla($_POST['talla']);
                $producto->setEstado($_POST['estado']);
                $producto->setIdCategoria($_POST['idCategoria']);
                $producto->setCategoria($_POST['categoria']);
                $producto->setIdUsuarioCreacion(1);
                $producto->setIdUsuarioModificacion(1);
                $producto = $producto->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR';
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try{
                $producto = new Producto();
                $producto->setIdProducto($_POST['id']);
                $producto->setDescripcion($_POST['descripcion']);
                $producto->setTalla($_POST['talla']);
                $producto->setEstado($_POST['estado']);
                $producto->setIdCategoria($_POST['idCategoria']);
                $producto->setCategoria($_POST['categoria']);
                $producto->setIdUsuarioModificacion();
                $resultado = $producto->Modificar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $producto = new Producto();
                $producto->setIdProducto($_POST['id']);
                $producto = $producto->Eliminar();
                $respuesta['respuesta']="La información se adicionó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $producto = new Producto();
                $producto->setIdProducto($_POST['id']);
                $producto->setDescripcion($_POST['descripcion']);
                $producto->setTalla($_POST['talla']);
                $producto->setEstado($_POST['estado']);
                $producto->setIdCategoria($_POST['idCategoria']);
                $producto->setCategoria($_POST['categoria']);
                $resultado = $producto->Consultar();

                $numeroRegistros = $producto->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $producto->conn->obtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_producto;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['idCategoria'] = $rowBuscar->id_categoria;
                        $respuesta['categoria'] = $rowBuscar->descripcion_cat;
                        $respuesta['talla'] = $rowBuscar->talla;
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_producto.")'>";
                     }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($producto->conn->ObtenerRegistros() AS $rowConsulta){
                            $retorno .= "<tr>
                                        <td><label>".$rowConsulta[1]."</label></td>
                                        <td><label>".$rowConsulta[3]."</label></td>
                                        <td><label>".$rowConsulta[4]."</label></td>      
                                        <td><label>".($rowConsulta[5] == 1 ? 'Activo' : 'Inactivo')."</label></td>                                           
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
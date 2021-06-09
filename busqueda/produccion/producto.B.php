<?php
require '../../entorno/conexion.php';
require '../../modelo/produccion/detalleOrden.M.php';
$arrDetalleOrden = array();
$contador = 0;
$detalleOrden = new DetalleOrden();
$detalleOrden->setIdProducto($_REQUEST['term']);
$detalleOrden->BuscarProducto();
$numeroRegistros = $detalleOrden->conn->obtenerNumeroRegistros();
while($rowDetalleOrden = $detalleOrden->conn->obtenerObjeto()){
    $arrDetalleOrden[$contador]['id'] = $rowDetalleOrden->id_producto;
    $arrDetalleOrden[$contador]['value'] = $rowDetalleOrden->descripcion;
    $contador++;
}
echo json_encode($arrDetalleOrden);
?>
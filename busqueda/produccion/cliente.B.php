<?php
require '../../entorno/conexion.php';
require '../../modelo/produccion/orden.M.php';
$arrOrden = array();
$contador = 0;
$orden = new Orden();
$orden->setDescripcion($_REQUEST['term']);
$orden->BuscarCliente();
$numeroRegistros = $orden->conn->obtenerNumeroRegistros();
while($rowOrden = $orden->conn->obtenerObjeto()){
    $arrOrden[$contador]['id'] = $rowOrden->id_cliente;
    $arrOrden[$contador]['value'] = $rowOrden->nombre;
    $contador++;
}
echo json_encode($arrOrden);
?>
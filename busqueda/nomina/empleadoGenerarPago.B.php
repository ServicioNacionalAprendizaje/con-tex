<?php
require '../../entorno/conexion.php';
require '../../modelo/nomina/generarPago.M.php';

$arrGenerarPago = array();
$contador = 0;
$generarPago = new GenerarPago();
$generarPago->BuscarEmpleado($_REQUEST['term']);
$numeroRegistros = $generarPago->conn->obtenerNumeroRegistros();
while($rowGenerarPago = $generarPago->conn->obtenerObjeto()){
    $arrGenerarPago[$contador]['id'] = $rowGenerarPago->id_empleado;
    $arrGenerarPago[$contador]['value'] = $rowGenerarPago->nombre;
    $contador++;
}
echo json_encode($arrGenerarPago);
?>
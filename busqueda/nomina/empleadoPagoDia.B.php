<?php
require '../../entorno/conexion.php';
require '../../modelo/nomina/pagoDia.M.php';

$arrPagoDia = array();
$contador = 0;
$pagoDia = new pagoDia();
$pagoDia->BuscarEmpleado($_REQUEST['term']);
$numeroRegistros = $pagoDia->conn->obtenerNumeroRegistros();
while($rowPagoDia = $pagoDia->conn->obtenerObjeto()){
    $arrPagoDia[$contador]['id'] = $rowPagoDia->id_empleado;
    $arrPagoDia[$contador]['value'] = $rowPagoDia->nombre;
    $contador++;
}
echo json_encode($arrPagoDia);
?>
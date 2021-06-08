<?php
require '../entorno/conexion.php';
require '../modelo/produccion/tarea.M.php';

$arrTarea = array();
$contador = 0;
$tarea = new Tarea();
$tarea->setDescripcion($_REQUEST['term']);
// $tarea->setApellido($_REQUEST['term']);

$tarea->BuscarEmpleado();
$numeroRegistros = $tarea->conn->obtenerNumeroRegistros();
while($rowTarea = $tarea->conn->obtenerObjeto()){
    $arrTarea[$contador]['id'] = $rowTarea->id_empleado;
    $arrTarea[$contador]['value'] = $rowTarea->nombre;

    $contador++;
}
echo json_encode($arrTarea);
?>
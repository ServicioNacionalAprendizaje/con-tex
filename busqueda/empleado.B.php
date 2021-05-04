<?php
require '../entorno/conexion.php';
require '../modelo/nomina/empleado.M.php';

$arrPersona = array();
$contador = 0;
$empleado = new Empleado();
$empleado->setIdCargo($_REQUEST['term']);
$empleado->setIdPersona($_REQUEST['term']);

$empleado->Consultar();
$numeroRegistros = $empleado->conn->obtenerNumeroRegistros();
while($rowPersona = $empleado->conn->obtenerObjeto()){
    $arrEmpleado[$contador]['id'] = $rowEmpleado->id_cargo;
    $arrEmpleado[$contador]['value'] = $rowEmpleado->id_cargo.' '.$rowEmpleado->apellido ;

    $contador++;
}
echo json_encode($arrEmpleado);
?>
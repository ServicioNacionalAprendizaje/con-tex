<!-- No estoy seguro si busca los nombres de los empleados -->
<?php
require '../entorno/conexion.php';
require '../modelo/nomina/empleado.M.php';

$arrEmpleado = array();
$contador = 0;
$empleado = new Empleado();
$empleado->setIdPersona($_REQUEST['term']);

$empleado->Consultar();
$numeroRegistros = $empleado->conn->obtenerNumeroRegistros();
while($rowEmpleado = $empleado->conn->obtenerObjeto()){
    $arrEmpleado[$contador]['id'] = $rowEmpleado->id_empleado;
    $arrEmpleado[$contador]['value'] = $rowEmpleado->id_persona ;

    $contador++;
}
echo json_encode($arrEmpleado);
?>
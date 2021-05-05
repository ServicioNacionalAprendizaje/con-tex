<?php
require '../entorno/conexion.php';
require '../modelo/nomina/cargo.M.php';

$arrCargo = array();
$contador = 0;
$cargo = new Cargo();
$cargo->setDescripcion($_REQUEST['term']);

$cargo->Consultar();
$numeroRegistros = $cargo->conn->obtenerNumeroRegistros();
while($rowCargo = $cargo->conn->obtenerObjeto()){
    $arrCargo[$contador]['id'] = $rowCargo->id_cargo;
    $arrCargo[$contador]['value'] = $rowCargo->descripcion ;

    $contador++;
}
echo json_encode($arrCargo);
?>
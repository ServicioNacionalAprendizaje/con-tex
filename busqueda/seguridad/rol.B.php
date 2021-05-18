<?php
require '../../entorno/conexion.php';
require '../../modelo/seguridad/rol.M.php';

$arrRol = array();
$contador = 0;
$rol = new Rol();
$rol->setDescripcion($_REQUEST['term']);

$rol->Consultar();
$numeroRegistros = $rol->conn->obtenerNumeroRegistros();
while($rowRol = $rol->conn->obtenerObjeto()){
    $arrRol[$contador]['id'] = $rowRol->id_rol;
    $arrRol[$contador]['value'] = $rowRol->descripcion;

    $contador++;
}
echo json_encode($arrRol);
?>

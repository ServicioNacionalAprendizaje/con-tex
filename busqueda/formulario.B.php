<?php
require '../entorno/conexion.php';
require '../modelo/seguridad/formulario.M.php';

$arrFormulario = array();
$contador = 0;
$formulario = new Formulario();
$formulario->setNombre($_REQUEST['term']);

$formulario->Consultar();
$numeroRegistros = $formulario->conn->obtenerNumeroRegistros();
while($rowFormulario = $formulario->conn->obtenerObjeto()){
    $arrFormulario[$contador]['id'] = $rowFormulario->id_Formulario;
    $arrFormulario[$contador]['value'] = $rowFormulario->descripion ;

    $contador++;
}
echo json_encode($arrFormulario);
?>
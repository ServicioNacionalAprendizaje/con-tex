<?php
require '../../entorno/conexion.php';
require '../../modelo/produccion/categoria.M.php';

$arrCategoria = array();
$contador = 0;
$categoria = new Categoria();
$categoria->setDescripcion($_REQUEST['term']);

$categoria->Consultar();
$numeroRegistros = $categoria->conn->obtenerNumeroRegistros();
while($rowCategoria = $categoria->conn->obtenerObjeto()){
    $arrCategoria[$contador]['id'] = $rowCategoria->id_categoria;
    $arrCategoria[$contador]['value'] = $rowCategoria->descripcion;

    $contador++;
}
echo json_encode($arrCategoria);
?>

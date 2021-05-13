<?php
require '../../entorno/conexion.php';
require '../../modelo/seguridad/usuario.M.php';

$arrUsuario = array();
$contador = 0;
$usuario = new Usuario();
$usuario->setUsuario($_REQUEST['term']);

$usuario->Consultar();
$numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
while($rowUsuario = $usuario->conn->obtenerObjeto()){
    $arrUsuario[$contador]['id'] = $rowUsuario->id_usuario;
    $arrUsuario[$contador]['value'] = $rowUsuario->usuario ;

    $contador++;
}
echo json_encode($arrUsuario);
?>
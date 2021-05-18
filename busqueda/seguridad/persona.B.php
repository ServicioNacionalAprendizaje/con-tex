<?php
require '../../entorno/conexion.php';
require '../../modelo/seguridad/persona.M.php';

$arrPersona = array();
$contador = 0;
$persona = new Persona();
$persona->setNombre($_REQUEST['term']);
// $persona->setApellido($_REQUEST['term']);

$persona->Consultar();
$numeroRegistros = $persona->conn->obtenerNumeroRegistros();
while($rowPersona = $persona->conn->obtenerObjeto()){
    $arrPersona[$contador]['id'] = $rowPersona->id_persona;
    $arrPersona[$contador]['value'] = $rowPersona->nombre.' '.$rowPersona->apellido ;

    $contador++;
}
echo json_encode($arrPersona);
?>

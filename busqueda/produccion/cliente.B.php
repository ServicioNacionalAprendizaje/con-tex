<!-- codigo proveniente de cliente, falta modificacion -->
<?php
require '../../entorno/conexion.php';
require '../../modelo/nomina/cliente.M.php';

$arrCliente = array();
$contador = 0;
$cliente = new Cliente();
$cliente->setDescripcion($_REQUEST['term']);

$cliente->Consultar();
$numeroRegistros = $cliente->conn->obtenerNumeroRegistros();
while($rowCliente = $cliente->conn->obtenerObjeto()){
    $arrCliente[$contador]['id'] = $rowCliente->id_cliente;
    $arrCliente[$contador]['value'] = $rowCliente->descripcion ;

    $contador++;
}
echo json_encode($arrCliente);
?>
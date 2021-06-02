<?php
// include '../../entorno/conexion.php';
// require '../../modelo/nomina/empleado.M.php';
// $contador = 0;
// $respuesta = array();
// $empleado = new Empleado();
// $empleado -> BuscarCorreo();
// $numeroRegistros = $empleado->conn->obtenerNumeroRegistros();
// $registros = $empleado->conn->ObtenerRegistros();
// foreach($empleado->conn->ObtenerRegistros() AS $rowConsulta){
//     $registros[$contador] = $rowConsulta[0];
//     $ids[$contador] = $rowConsulta[1];
//     $contador++;
// }
// $correo = $_POST['correo'];
// if (in_array($correo, $registros)) {
//     $index = array_search($correo, $registros);
//     $respuesta['id'] = $ids[$index];
//     $respuesta['respuesta'] = "Correo confirmado.";
//     $respuesta['estado'] = true;
// } else {
//     $respuesta['respuesta'] = "El correo no se encuentra registrado.";
//     $respuesta['estado'] = false;
// }

// $aaa = array_column($registros, 0);
// $llave = array_search($correo, array_column($registros, 0));
// if ($llave) {
//     $respuesta['respuesta'] = "Correo confirmado.";
// } else {
//     $respuesta['respuesta'] = "El correo no se encuentra registrado.";
// }
// echo json_encode($respuesta);
?>
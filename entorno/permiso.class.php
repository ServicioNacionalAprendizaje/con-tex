<?php session_start();
if($_SESSION['autenticado'] == 0){
    echo "<script>alert('Debe autenticarse para poder acceder al formulario.')</script>";
    exit();
}
?>

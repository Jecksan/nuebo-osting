<?php
$conexion = new mysqli("localhost", "root", "", "recibo_de_dinero");

if ($conexion->connect_errno) {
    echo "Error al conectar: " . $conexion->connect_error;
    exit();
}
?>

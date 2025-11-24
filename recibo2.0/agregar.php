<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit();
}
?>

<?php
include("db.php");

$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$semestre = $_POST['semestre'];
$aportacion = $_POST['aportacion_v'];
$paraescolar = $_POST['paraescolar'];
$credencial = $_POST['credencial'];
$otro = $_POST['otro'];
$total = $_POST['total_pagar'];
$firma_al = $_POST['firma_alumno'];
$firma_en = $_POST['firma_entrega'];

$sql = "INSERT INTO recibos VALUES(NULL,'$nombre','$fecha','$semestre','$aportacion','$paraescolar','$credencial','$otro','$total','$firma_al','$firma_en')";

$conexion->query($sql);

header("Location: index.php");
?>

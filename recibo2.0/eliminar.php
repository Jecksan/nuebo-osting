<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit();
}
?>

<?php
include("db.php");

$id = $_GET['id'];

$conexion->query("DELETE FROM recibos WHERE id=$id");

header("Location: index.php");
?>

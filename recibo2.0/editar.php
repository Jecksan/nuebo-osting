<?php include("db.php");

$id = $_GET['id'];
$consulta = $conexion->query("SELECT * FROM recibos WHERE id=$id");
$fila = $consulta->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Editar</title></head>
<body>

<h2>Editar Recibo</h2>

<form method="POST" action="editar.php?id=<?= $id ?>">
    Nombre: <input type="text" name="nombre" value="<?= $fila['nombre'] ?>"><br>
    Fecha: <input type="date" name="fecha" value="<?= $fila['fecha'] ?>"><br>
    Semestre: <input type="text" name="semestre" value="<?= $fila['semestre'] ?>"><br>
    Aportación: <input type="number" name="aportacion_v" value="<?= $fila['aportacion_v'] ?>"><br>
    Paraescolar: <input type="number" name="paraescolar" value="<?= $fila['paraescolar'] ?>"><br>
    Credencial: <input type="number" name="credencial" value="<?= $fila['credencial'] ?>"><br>
    Otro: <input type="text" name="otro" value="<?= $fila['otro'] ?>"><br>
    Total: <input type="number" name="total_pagar" value="<?= $fila['total_pagar'] ?>"><br>
    Firma Alumno: <input type="text" name="firma_alumno" value="<?= $fila['firma_alumno'] ?>"><br>
    Firma Entrega: <input type="text" name="firma_entrega" value="<?= $fila['firma_entrega'] ?>"><br><br>

    <input type="submit" name="guardar" value="Guardar cambios">
</form>

<?php
if(isset($_POST['guardar'])){
    $sql = "UPDATE recibos SET 
            nombre='{$_POST['nombre']}',
            fecha='{$_POST['fecha']}',
            semestre='{$_POST['semestre']}',
            aportacion_v='{$_POST['aportacion_v']}',
            paraescolar='{$_POST['paraescolar']}',
            credencial='{$_POST['credencial']}',
            otro='{$_POST['otro']}',
            total_pagar='{$_POST['total_pagar']}',
            firma_alumno='{$_POST['firma_alumno']}',
            firma_entrega='{$_POST['firma_entrega']}'
            WHERE id=$id";

    $conexion->query($sql);

    header("Location: index.php");
}
?>
</body>
</html>

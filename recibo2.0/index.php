<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Recibos</title>

<style>
body{
    font-family: Arial;
    background:#f2f2f2;
    padding:30px;
}

/* Tabla */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
th,td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
th{
    background:#2e86de;
    color:white;
}

/* Botones */
.btn{
    padding:8px 14px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    color:white;
    transition:0.3s ease;
}
.btn:hover{ transform:scale(1.1); }

.add{ background:#27ae60; }
.edit{ background:#f1c40f; color:black; }
.delete{ background:#e74c3c; }

/* Modal */
.modal{
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.5);
    display:flex;
    align-items:center;
    justify-content:center;
    visibility:hidden;
    opacity:0;
    transition:0.4s;
}
.modal.show{
    visibility:visible;
    opacity:1;
}

.modal-content{
    background:white;
    padding:25px;
    border-radius:10px;
    width:450px;
    animation:pop 0.4s ease;
}
@keyframes pop{
    from{transform:scale(0.5); opacity:0;}
    to{transform:scale(1); opacity:1;}
}
</style>

<script>
// abrir modal
function abrirModal(id){
    document.getElementById(id).classList.add("show");
}

// cerrar modal
function cerrarModal(id){
    document.getElementById(id).classList.remove("show");
}
</script>

</head>
<body>

<h1 style="text-align:center;">Gestión de Recibos</h1>

<button class="btn add" onclick="abrirModal('modalAgregar')">+ Agregar Recibo</button>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Semestre</th>
        <th>Aportación</th>
        <th>Paraescolar</th>
        <th>Credencial</th>
        <th>Otro</th>
        <th>Total</th>
        <th>Firma Alumno</th>
        <th>Firma Entrega</th>
        <th>Acciones</th>
    </tr>

<?php
$consulta = $conexion->query("SELECT * FROM recibos");
while($fila = $consulta->fetch_assoc()){
?>
<tr>
    <td><?= $fila["id"] ?></td>
    <td><?= $fila["nombre"] ?></td>
    <td><?= $fila["fecha"] ?></td>
    <td><?= $fila["semestre"] ?></td>
    <td><?= $fila["aportacion_v"] ?></td>
    <td><?= $fila["paraescolar"] ?></td>
    <td><?= $fila["credencial"] ?></td>
    <td><?= $fila["otro"] ?></td>
    <td><?= $fila["total_pagar"] ?></td>
    <td><?= $fila["firma_alumno"] ?></td>
    <td><?= $fila["firma_entrega"] ?></td>

    <td>
        <a href="editar.php?id=<?= $fila['id'] ?>"><button class="btn edit">Editar</button></a>
        <a href="eliminar.php?id=<?= $fila['id'] ?>"><button class="btn delete">Eliminar</button></a>
    </td>
</tr>
<?php } ?>
</table>


<!-- MODAL AGREGAR -->
<div class="modal" id="modalAgregar">
    <div class="modal-content">
        <h2>Agregar Recibo</h2>

        <form action="agregar.php" method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" required><br><br>

            <label>Fecha:</label>
            <input type="date" name="fecha" required><br><br>

            <label>Semestre:</label>
            <input type="text" name="semestre"><br><br>

            <label>Aportación voluntaria:</label>
            <input type="number" name="aportacion_v"><br><br>

            <label>Paraescolar:</label>
            <input type="number" name="paraescolar"><br><br>

            <label>Credencial:</label>
            <input type="number" name="credencial"><br><br>

            <label>Otro:</label>
            <input type="text" name="otro"><br><br>

            <label>Total a pagar:</label>
            <input type="number" name="total_pagar"><br><br>

            <label>Firma Alumno:</label>
            <input type="text" name="firma_alumno"><br><br>

            <label>Firma Entrega:</label>
            <input type="text" name="firma_entrega"><br><br>

            <button class="btn add" type="submit">Guardar</button>
            <button class="btn delete" type="button" onclick="cerrarModal('modalAgregar')">Cancelar</button>
        </form>
    </div>
</div>

</body>
</html>

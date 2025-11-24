<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit();
}
?>

<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Recibos</title>

<!-- ======================  ESTILOS MODERNOS  ====================== -->
<style>
:root {
    --primary: #4c6ef5;
    --primary-light: #7b8cff;
    --accent: #22b8cf;
    --danger: #fa5252;
    --success: #40c057;
    --warning: #fab005;
    --bg: #f3f4f7;
    --text: #2d3436;
    --shadow: 0px 4px 20px rgba(0,0,0,0.1);
}

/* Fondo general */
body {
    margin: 0;
    padding: 40px;
    background: linear-gradient(135deg, #dfe9f3, #ffffff);
    font-family: "Poppins", sans-serif;
    color: var(--text);
}

/* Contenedor principal */
.container {
    max-width: 1250px;
    margin: auto;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(12px);
    padding: 30px;
    border-radius: 18px;
    box-shadow: var(--shadow);
    animation: fadeIn 0.8s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Título */
h1 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
    letter-spacing: 1px;
    background: linear-gradient(to right, var(--primary), var(--accent));
    -webkit-background-clip: text;
    color: transparent;
    animation: glow 3s infinite alternate ease-in-out;
}

@keyframes glow {
    0% { text-shadow: 0 0 10px rgba(76,110,245,.3); }
    100% { text-shadow: 0 0 20px rgba(76,110,245,.6); }
}

/* Tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: var(--shadow);
}

thead tr {
    background: var(--primary);
    color: white;
}

th, td {
    padding: 14px;
    text-align: center;
}

tbody tr {
    background: white;
    transition: 0.3s ease;
}

tbody tr:hover {
    background: #eef2ff;
    transform: scale(1.01);
}

/* Botones */
.btn {
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    letter-spacing: .5px;
    transition: .3s ease-out;
    color: white;
}

.btn:hover {
    transform: translateY(-3px);
}

.add { background: var(--success); }
.edit { background: var(--warning); color: black; }
.delete { background: var(--danger); }

/* Modal */
.modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0; visibility: hidden;
    transition: 0.4s ease-in-out;
}

.modal.show {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    width: 480px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(12px);
    padding: 30px;
    border-radius: 15px;
    box-shadow: var(--shadow);
    animation: modalPop 0.5s cubic-bezier(.17,.67,.3,1.27);
}

@keyframes modalPop {
    from { transform: scale(0.6); opacity:0; }
    to   { transform: scale(1); opacity:1; }
}

/* Inputs */
input {
    width: 100%;
    padding: 10px;
    margin-bottom: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: 0.3s ease;
}

input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 8px rgba(76,110,245,0.3);
}
</style>

</head>
<body>

<!-- ======================  CONTENIDO PRINCIPAL  ====================== -->

<div class="container">

<h1>Gestión de Recibos</h1>

<div style="text-align:right; margin-bottom:20px;">
    <a href="logout.php">
        <button class="btn delete">Cerrar sesión</button>
    </a>
</div>


<button class="btn add" onclick="abrirModal('modalAgregar')">+ Agregar Recibo</button>

<table>
    <thead>
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
    </thead>
    <tbody>

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

</tbody>
</table>

</div>

<!-- ======================  MODAL AGREGAR  ====================== -->

<div class="modal" id="modalAgregar">
    <div class="modal-content">
        <h2 style="text-align:center;">Agregar Recibo</h2>

        <form action="agregar.php" method="POST">

            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="date" name="fecha" required>
            <input type="text" name="semestre" placeholder="Semestre">
            <input type="number" name="aportacion_v" placeholder="Aportación Voluntaria">
            <input type="number" name="paraescolar" placeholder="Paraescolar">
            <input type="number" name="credencial" placeholder="Credencial">
            <input type="text" name="otro" placeholder="Otro">
            <input type="number" name="total_pagar" placeholder="Total a pagar">
            <input type="text" name="firma_alumno" placeholder="Firma del Alumno">
            <input type="text" name="firma_entrega" placeholder="Firma de Entrega">

            <button class="btn add" type="submit">Guardar</button>
            <button class="btn delete" type="button" onclick="cerrarModal('modalAgregar')">Cancelar</button>
        </form>
    </div>
</div>

<!-- ======================  SCRIPTS  ====================== -->
<script>
function abrirModal(id){
    document.getElementById(id).classList.add("show");
}

function cerrarModal(id){
    document.getElementById(id).classList.remove("show");
}
</script>

</body>
</html>

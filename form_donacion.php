<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Donación</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Donación</h2>
        <form method="POST" action="procesar_donacion.php">
            <label for="monto">Monto (USD):</label>
            <input type="number" name="monto" min="1" required>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required>

            <label for="id_proyecto">Proyecto:</label>
            <select name="id_proyecto" required>
                <?php
                include('conexion.php');
                $stmt = $conn->query("SELECT id_proyecto, nombre FROM PROYECTO");
                foreach ($stmt as $row) {
                    echo "<option value='{$row['id_proyecto']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>

            <label for="id_donante">Donante:</label>
            <select name="id_donante" required>
                <?php
                $stmt = $conn->query("SELECT id_donante, nombre FROM DONANTE");
                foreach ($stmt as $row) {
                    echo "<option value='{$row['id_donante']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>

            <input class="submit-btn" type="submit" value="Guardar Donación">
        </form>
    </div>
</body>
</html>

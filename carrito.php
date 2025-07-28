<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar donación al carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    $campana = isset($_POST['campana']) ? htmlspecialchars($_POST['campana']) : null;
    $monto = isset($_POST['monto']) ? floatval($_POST['monto']) : 0;

    if ($campana && $monto > 0) {
        $_SESSION['carrito'][] = [
            'campana' => $campana,
            'monto' => $monto
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Donaciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">
    <h2>Agregar Donación</h2>
    <form method="POST" action="carrito.php">
        <label for="campana">Selecciona una campaña:</label>
        <select name="campana" id="campana" required>
            <option value="Educación">Educación</option>
            <option value="Salud">Salud</option>
            <option value="Medio ambiente">Medio ambiente</option>
        </select>

        <label for="monto">Monto a donar (USD):</label>
        <input type="number" name="monto" id="monto" min="1" required>

        <input class="submit-btn" type="submit" name="agregar" value="Agregar al carrito">
    </form>

    <h2>Carrito de Donaciones</h2>
    <?php if (!empty($_SESSION['carrito'])): ?>
        <ul>
            <?php
            $total = 0;
            foreach ($_SESSION['carrito'] as $donacion) {
                $campana = isset($donacion['campana']) ? $donacion['campana'] : 'campaña desconocida';
                $monto = isset($donacion['monto']) ? $donacion['monto'] : 0;
                echo "<li>Campaña: <strong>{$campana}</strong> - Monto: <strong>\${$monto}</strong></li>";
                $total += $monto;
            }
            ?>
        </ul>
        <p><strong>Total a donar:</strong> $<?= $total ?></p>
        <form method="POST" action="vaciar_carrito.php">
            <input type="submit" class="submit-btn" value="Vaciar carrito">
        </form>
    <?php else: ?>
        <p>No hay donaciones en el carrito.</p>
    <?php endif; ?>

    <div style="margin-top: 30px;">
    <a href="index.html" class="submit-btn">Volver al Inicio</a>
    </div>

</div>
</body>
</html>

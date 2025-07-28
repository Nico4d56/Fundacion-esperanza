<?php
function procesarDonacion($nombre, $correo, $monto, $mensaje, $campana) {
    echo "<div class='container'>";
    echo "<h2>¡Gracias por tu donación, $nombre!</h2>";
    echo "<p><strong>Correo:</strong> $correo</p>";
    echo "<p><strong>Monto donado:</strong> $monto USD</p>";
    echo "<p><strong>Mensaje:</strong> $mensaje</p>";
    echo "<p><strong>Campaña seleccionada:</strong> " . ucfirst($campana) . "</p>";
    echo "</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['donar'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $monto = htmlspecialchars($_POST['monto']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    $campana = htmlspecialchars($_POST['campana']);

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Donación Recibida</title>
        <link rel='stylesheet' href='estilos.css'>
    </head>
    <body>";

    procesarDonacion($nombre, $correo, $monto, $mensaje, $campana);

    echo "</body>
    </html>";
} else {
    echo "<p>No se ha enviado ninguna donación.</p>";
}
?>

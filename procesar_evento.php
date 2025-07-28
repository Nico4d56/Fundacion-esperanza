<?php
include("Evento.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_evento'])) {
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $lugar = htmlspecialchars($_POST['lugar']);
    $fecha = htmlspecialchars($_POST['fecha']);
    $hora = htmlspecialchars($_POST['hora']);

    $evento = new Evento($descripcion, $tipo, $lugar, $fecha, $hora);

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Evento Registrado</title>
        <link rel='stylesheet' href='estilos.css'>
    </head>
    <body>";

    echo $evento->mostrarEvento();

    echo "</body>
    </html>";
} else {
    echo "<p>Error: No se recibió información del evento.</p>";
}
?>

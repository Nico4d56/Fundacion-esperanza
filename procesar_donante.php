<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);

    $sql = "INSERT INTO DONANTE (nombre, email, direccion, telefono)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre, $email, $direccion, $telefono]);

    echo "<p>Donante registrado correctamente.</p>";
    echo "<a href='form_donante.html'>Volver</a>";
}
?>

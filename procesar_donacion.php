<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = floatval($_POST['monto']);
    $fecha = $_POST['fecha'];
    $id_proyecto = intval($_POST['id_proyecto']);
    $id_donante = intval($_POST['id_donante']);

    if ($monto <= 0 || !$fecha || $id_proyecto <= 0 || $id_donante <= 0) {
        die("Datos inválidos.");
    }

    $sql = "INSERT INTO DONACION (monto, fecha, id_proyecto, id_donante) 
            VALUES (:monto, :fecha, :id_proyecto, :id_donante)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':monto', $monto);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':id_proyecto', $id_proyecto);
    $stmt->bindParam(':id_donante', $id_donante);

    if ($stmt->execute()) {
        echo "Donación registrada correctamente.";
    } else {
        echo "Error al registrar donación.";
    }
}
?>
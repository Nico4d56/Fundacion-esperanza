<?php
// conexion.php
$host = 'localhost';
$db = 'ORGANIZACION';
$user = 'root';
$pass = ''; // Por defecto en XAMPP, sin contraseña

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>

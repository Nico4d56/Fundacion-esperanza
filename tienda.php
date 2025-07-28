<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si se envió un producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_producto'])) {
    $producto = htmlspecialchars($_POST['producto']);
    $precio = floatval($_POST['precio']);

    $_SESSION['carrito'][] = [
        'tipo' => 'producto',
        'nombre' => $producto,
        'monto' => $precio
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Solidaria</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header>
    <h1>Fundación Esperanza</h1>
    <nav>
        <a href="index.html">Inicio</a>
        <a href="donar.php">Haz una Donación</a>
        <a href="form_evento.php">Registrar Evento</a>
        <a href="carrito.php">Carrito</a>
        <a href="tienda.php">Tienda</a>
    </nav>
</header>

<div class="container">
    <h2>Tienda Solidaria</h2>

    <form method="POST" action="tienda.php">
        <label for="producto">Selecciona un producto:</label>
        <select name="producto" id="producto">
            <option value="Polera blanca">Polera blanca - $15</option>
            <option value="Polera negra">Polera negra - $18</option>
            <option value="Polera edición especial">Polera edición especial - $25</option>
        </select>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" value="15" required>

        <input class="submit-btn" type="submit" name="agregar_producto" value="Agregar al carrito">
    </form>

    <script>
        // Cambiar precio automáticamente según producto
        document.getElementById('producto').addEventListener('change', function () {
            const precios = {
                "Polera blanca": 15,
                "Polera negra": 18,
                "Polera edición especial": 25
            };
            document.getElementById('precio').value = precios[this.value];
        });
    </script>
</div>
</body>
</html>

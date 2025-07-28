<?php
session_start();

// --- Lógica PHP ---

// Inicializar el carrito si no existe en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Precios actualizados a Pesos Chilenos (CLP) - Fuente de verdad
$productos_disponibles = [
    "Polera blanca" => 15000,
    "Polera negra" => 18000,
    "Polera edición especial" => 25000
];

// Función auxiliar para establecer mensajes en la sesión
function setMensajeTienda($texto, $tipo) {
    $_SESSION['mensaje_tienda'] = [
        'texto' => $texto,
        'tipo' => $tipo
    ];
}

// Lógica para agregar productos al carrito
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['agregar_producto'])) {
    $producto_solicitado = htmlspecialchars(trim($_POST['producto'] ?? ''));
    $precio_enviado = floatval($_POST['precio'] ?? 0);

    // 1. Validar que el producto solicitado existe en nuestra lista
    if (!isset($productos_disponibles[$producto_solicitado])) {
        setMensajeTienda("Error: Producto no válido. Por favor, seleccione un producto de la lista.", 'error');
    } else {
        $precio_real = $productos_disponibles[$producto_solicitado];

        // 2. Verificar que el precio enviado coincide con el precio real del servidor
        if ($precio_enviado !== $precio_real) { // Usamos !== para asegurar tipo y valor
            setMensajeTienda("Error: El precio del producto no es válido. Intente de nuevo.", 'error');
        } else {
            // Producto y precio válidos, agregar al carrito
            $_SESSION['carrito'][] = [
                'tipo' => 'producto',
                'nombre' => $producto_solicitado,
                'monto' => $precio_real
            ];
            setMensajeTienda("¡'{$producto_solicitado}' agregado al carrito con éxito!", 'success');
        }
    }
    
    // Redireccionar para evitar re-envío del formulario (Patrón PRG)
    header("Location: tienda.php");
    exit(); 
}

// Lógica para mostrar mensajes (solo si hay un mensaje en la sesión)
$mensaje_html = '';
if (isset($_SESSION['mensaje_tienda'])) {
    $msg_data = $_SESSION['mensaje_tienda'];
    $clase_css = 'info-mensaje'; // Default
    if ($msg_data['tipo'] === 'success') {
        $clase_css = 'mensaje-exito';
    } elseif ($msg_data['tipo'] === 'error') {
        $clase_css = 'mensaje-error';
    }
    $mensaje_html = "<p class='" . $clase_css . "'>" . htmlspecialchars($msg_data['texto']) . "</p>";
    unset($_SESSION['mensaje_tienda']); // Limpiar el mensaje después de mostrarlo
}

// --- Fin Lógica PHP ---
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

    <?php echo $mensaje_html; // Mostrar el mensaje aquí ?>

    <form method="POST" action="tienda.php">
        <label for="producto">Selecciona un producto:</label>
        <select name="producto" id="producto">
            <?php foreach ($productos_disponibles as $nombre_prod => $precio_prod): ?>
                <option value="<?= htmlspecialchars($nombre_prod) ?>"><?= htmlspecialchars($nombre_prod) ?> - CLP$ <?= number_format($precio_prod, 0, ',', '.') ?></option>
            <?php endforeach; ?>
        </select>

        <label for="precio">Precio (CLP):</label>
        <input type="number" name="precio" id="precio" value="<?= number_format($productos_disponibles['Polera blanca'], 0, ',', '.') ?>" step="0.01" required readonly> 
        <input class="submit-btn" type="submit" name="agregar_producto" value="Agregar al carrito">
    </form>

    <script>
        // Array de precios en JavaScript (debe coincidir con el PHP)
        const precios_js = {
            <?php
            $js_products_array = [];
            foreach ($productos_disponibles as $nombre_prod => $precio_prod) {
                // Asegurarse de que los precios en JS sean números flotantes para cálculos si es necesario
                $js_products_array[] = json_encode($nombre_prod) . ': ' . $precio_prod;
            }
            echo implode(",\n            ", $js_products_array);
            ?>
        };

        document.getElementById('producto').addEventListener('change', function () {
            const selectedProduct = this.value;
            if (precios_js.hasOwnProperty(selectedProduct)) {
                // Formatear el número para la visualización si es necesario
                document.getElementById('precio').value = precios_js[selectedProduct].toLocaleString('es-CL');
            } else {
                document.getElementById('precio').value = '';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const initialProduct = document.getElementById('producto').value;
            if (precios_js.hasOwnProperty(initialProduct)) {
                // Formatear el número inicial también
                document.getElementById('precio').value = precios_js[initialProduct].toLocaleString('es-CL');
            }
        });
    </script>
</div>
</body>
</html>
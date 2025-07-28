<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Donar - Fundación Esperanza</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Realiza tu Donación</h2>
        <form method="POST" action="donacion.php">
            <label for="nombre">Nombre completo:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="correo">Correo electrónico:</label>
            <input type="email" name="correo" id="correo" required>

            <label for="monto">Monto a donar (USD):</label>
            <input type="number" name="monto" id="monto" required min="1">

            <label for="mensaje">Mensaje o dedicatoria (opcional):</label>
            <textarea name="mensaje" id="mensaje" rows="4"></textarea>

            <label for="campana">Selecciona una campaña:</label>
            <select name="campana" id="campana">
                <option value="educacion">Educación</option>
                <option value="salud">Salud</option>
                <option value="medioambiente">Medio ambiente</option>
            </select>

            <input class="submit-btn" type="submit" name="donar" value="Donar ahora">
        </form>
    </div>
</body>
</html>

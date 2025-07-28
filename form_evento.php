<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Evento</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Evento</h2>
        <form method="POST" action="procesar_evento.php">
            <label for="descripcion">Descripción del evento:</label>
            <input type="text" name="descripcion" id="descripcion" required>

            <label for="tipo">Tipo de evento:</label>
            <input type="text" name="tipo" id="tipo" required>

            <label for="lugar">Lugar:</label>
            <input type="text" name="lugar" id="lugar" required>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora" required>

            <input class="submit-btn" type="submit" name="registrar_evento" value="Registrar evento">
        </form>
    </div>
</body>
</html>

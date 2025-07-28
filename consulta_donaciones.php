<?php
include("conexion.php");

$sql = "
SELECT p.id_proyecto, p.nombre, COUNT(d.id_donacion) AS cantidad_donaciones, SUM(d.monto) AS total_recaudado
FROM PROYECTO p
JOIN DONACION d ON p.id_proyecto = d.id_proyecto
GROUP BY p.id_proyecto, p.nombre
HAVING cantidad_donaciones > 2
ORDER BY total_recaudado DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Proyectos con más de dos donaciones</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID Proyecto</th><th>Nombre</th><th>Donaciones</th><th>Total Recaudado (USD)</th></tr>";

foreach ($resultados as $fila) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila['id_proyecto']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['cantidad_donaciones']) . "</td>";
    echo "<td>$" . number_format($fila['total_recaudado'], 2) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
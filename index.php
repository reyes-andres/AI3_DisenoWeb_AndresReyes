<?php
// Punto de entrada del sistema
// Prueba de conexión con la base de datos

require_once __DIR__ . '/config/conexion.php';

$conectado = false;

try {
    $conexion = obtenerConexion();
    $conectado = true;
} catch (Exception $e) {
    $conectado = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <h1 class="mb-4">Registro de Equipos de Videovigilancia</h1>

        <?php if ($conectado): ?>
            <div class="alert alert-success">Conexión con la base de datos establecida.</div>
        <?php else: ?>
            <div class="alert alert-danger">No se pudo conectar con la base de datos.</div>
        <?php endif; ?>
    </main>
</body>
</html>
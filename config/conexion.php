<?php
// Conexión a la base de datos usando PDO

// Si no existe el archivo de configuración, se avisa sin mostrar rutas ni datos
if (!file_exists(__DIR__ . '/config.php')) {
    exit('Falta el archivo config/config.php. Revisa el README.');
}

require_once __DIR__ . '/config.php';

function obtenerConexion(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';

    $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,      // los errores se lanzan como excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // resultados como arreglo asociativo
        PDO::ATTR_EMULATE_PREPARES => false,              // sentencias preparadas reales en el servidor
    ];

    try {
        return new PDO($dsn, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
        // El detalle se guarda en el log del servidor, no se muestra al usuario
        error_log('Error de conexión: ' . $e->getMessage());

        // Se lanza un mensaje general, sin credenciales ni datos del sistema
        throw new Exception('No se pudo conectar con la base de datos.');
    }
}
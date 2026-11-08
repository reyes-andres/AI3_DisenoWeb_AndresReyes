<?php
// Punto de entrada del sistema (front controller)
// Recibe todas las peticiones y llama al controlador

require_once __DIR__ . '/controllers/EquipoController.php';

$controller = new EquipoController();

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($metodo === 'POST' && ($_POST['accion'] ?? '') === 'guardar') {
    $controller->guardar();
    exit;
}

$controller->index();
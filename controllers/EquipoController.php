<?php
// Controlador de equipos: recibe la petición, valida los datos y llama al modelo

require_once __DIR__ . '/../models/Equipo.php';

class EquipoController
{
    // Muestra la página principal con la lista de equipos
    public function index(): void
    {
        $mensaje = $_GET['mensaje'] ?? null;
        $error = $_GET['error'] ?? null;

        try {
            $equipoModel = new Equipo();
            $equipos = $equipoModel->obtenerTodos();
        } catch (Exception $e) {
            $equipos = [];
            $error = 'conexion';
        }

        require __DIR__ . '/../vistas/equipos.php';
    }
    // Recibe el formulario, valida y guarda
    public function guardar(): void
    {
        // Se leen los datos y se quitan los espacios
        $nombre = trim($_POST['nombre'] ?? '');
        $tipo = $_POST['tipo'] ?? '';
        $marca = trim($_POST['marca'] ?? '');
        $direccionIp = trim($_POST['direccion_ip'] ?? '');
        $ubicacion = trim($_POST['ubicacion'] ?? '');
        $estado = $_POST['estado'] ?? '';

        // Valores permitidos (los mismos del ENUM de la base de datos)
        $tiposPermitidos = ['Camara', 'Grabador', 'Switch'];
        $estadosPermitidos = ['Activo', 'Inactivo', 'Mantenimiento'];

        // Validación 1: campos obligatorios
        if ($nombre === '' || $marca === '' || $direccionIp === '' || $ubicacion === '') {
            $this->redirigir('error=campos_vacios');
        }

        // Validación 2: largo máximo (igual al de la tabla)
        if (mb_strlen($nombre) > 100 || mb_strlen($marca) > 50 || mb_strlen($ubicacion) > 150) {
            $this->redirigir('error=longitud');
        }

        // Validación 3: tipo y estado deben estar en la lista permitida
        if (!in_array($tipo, $tiposPermitidos, true) || !in_array($estado, $estadosPermitidos, true)) {
            $this->redirigir('error=opcion_invalida');
        }

        // Validación 4: formato de IPv4
        if (filter_var($direccionIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
            $this->redirigir('error=ip_invalida');
        }

        try {
            $equipoModel = new Equipo();
            $equipoModel->guardar($nombre, $tipo, $marca, $direccionIp, $ubicacion, $estado);
        } catch (PDOException $e) {
            // Código 23000: la IP ya existe (restricción UNIQUE)
            if ($e->getCode() == 23000) {
                $this->redirigir('error=ip_duplicada');
            }

            error_log('Error al guardar equipo: ' . $e->getMessage());
            $this->redirigir('error=bd');
        } catch (Exception $e) {
            $this->redirigir('error=conexion');
        }

        // Patrón PRG: después de guardar se redirige para evitar reenvíos con F5
        $this->redirigir('mensaje=guardado');
    }

    // Redirige a la página principal con un mensaje en la URL
    private function redirigir(string $parametros): void
    {
        header('Location: index.php?' . $parametros);
        exit;
    }
}
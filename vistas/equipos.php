<?php
// Vista principal: formulario de registro de equipos

$mensaje = $mensaje ?? null;
$error = $error ?? null;

// Mensajes de error que puede enviar el controlador
$mensajesError = [
    'campos_vacios' => 'Completa todos los campos.',
    'longitud' => 'Uno de los campos supera el largo permitido.',
    'opcion_invalida' => 'El tipo o el estado seleccionado no es válido.',
    'ip_invalida' => 'La dirección IP no tiene un formato válido.',
    'ip_duplicada' => 'Ya existe un equipo registrado con esa dirección IP.',
    'conexion' => 'Error al conectar con la base de datos.',
    'bd' => 'No se pudo guardar el equipo. Intenta de nuevo.',
];
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

        <?php if ($mensaje === 'guardado'): ?>
            <div class="alert alert-success">Equipo guardado correctamente.</div>
        <?php endif; ?>

        <?php if ($error !== null && isset($mensajesError[$error])): ?>
            <div class="alert alert-danger"><?php echo $mensajesError[$error]; ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <section class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Registrar equipo
                    </div>
                    <div class="card-body">
                        <form id="formEquipo" action="index.php" method="POST" novalidate>
                            <input type="hidden" name="accion" value="guardar">

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       maxlength="100" placeholder="Ej: Cámara acceso principal" required>
                                <div class="invalid-feedback">Ingresa el nombre del equipo.</div>
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="Camara">Cámara</option>
                                    <option value="Grabador">Grabador</option>
                                    <option value="Switch">Switch</option>
                                </select>
                                <div class="invalid-feedback">Selecciona el tipo de equipo.</div>
                            </div>

                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca"
                                       maxlength="50" placeholder="Ej: Hikvision" required>
                                <div class="invalid-feedback">Ingresa la marca.</div>
                            </div>

                            <div class="mb-3">
                                <label for="direccion_ip" class="form-label">Dirección IP</label>
                                <input type="text" class="form-control" id="direccion_ip" name="direccion_ip"
                                       maxlength="45" placeholder="Ej: 192.168.1.64"
                                       pattern="((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.){3}(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)"
                                       required>
                                <div class="invalid-feedback">Ingresa una IPv4 válida (ej: 192.168.1.64).</div>
                            </div>

                            <div class="mb-3">
                                <label for="ubicacion" class="form-label">Ubicación</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                                       maxlength="150" placeholder="Ej: Bodega, pasillo 2" required>
                                <div class="invalid-feedback">Ingresa la ubicación.</div>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Mantenimiento">Mantenimiento</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="public/js/script.js"></script>
</body>
</html>
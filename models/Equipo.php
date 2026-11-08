<?php
// Modelo Equipo: se encarga de trabajar con la tabla equipos

require_once __DIR__ . '/../config/conexion.php';

class Equipo
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = obtenerConexion();
    }

    // Inserta un equipo usando una sentencia preparada
    public function guardar(string $nombre, string $tipo, string $marca, string $direccionIp, string $ubicacion, string $estado): bool
    {
        $sql = 'INSERT INTO equipos (nombre, tipo, marca, direccion_ip, ubicacion, estado)
                VALUES (:nombre, :tipo, :marca, :direccion_ip, :ubicacion, :estado)';

        // 1. Se prepara la consulta (los datos todavía no están dentro del SQL)
        $sentencia = $this->conexion->prepare($sql);

        // 2. Se enlaza cada dato a su marcador
        $sentencia->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $sentencia->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $sentencia->bindValue(':marca', $marca, PDO::PARAM_STR);
        $sentencia->bindValue(':direccion_ip', $direccionIp, PDO::PARAM_STR);
        $sentencia->bindValue(':ubicacion', $ubicacion, PDO::PARAM_STR);
        $sentencia->bindValue(':estado', $estado, PDO::PARAM_STR);

        // 3. Se ejecuta
        return $sentencia->execute();
    }

    // Devuelve todos los equipos, del más reciente al más antiguo
    public function obtenerTodos(): array
    {
        $sql = 'SELECT id, nombre, tipo, marca, direccion_ip, ubicacion, estado, fecha_creacion
                FROM equipos
                ORDER BY id DESC';

        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();

        return $sentencia->fetchAll();
    }
}
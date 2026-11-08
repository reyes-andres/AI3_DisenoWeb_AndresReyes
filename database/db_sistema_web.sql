-- Script DDL de la base de datos
-- Actividad Integradora 3 - Registro de equipos de videovigilancia

CREATE DATABASE IF NOT EXISTS db_sistema_web
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE db_sistema_web;

-- Tabla principal: equipos de videovigilancia
CREATE TABLE IF NOT EXISTS equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('Camara', 'Grabador', 'Switch') NOT NULL,
    marca VARCHAR(50) NOT NULL,
    direccion_ip VARCHAR(45) NOT NULL UNIQUE,
    ubicacion VARCHAR(150) NOT NULL,
    estado ENUM('Activo', 'Inactivo', 'Mantenimiento') NOT NULL DEFAULT 'Activo',
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
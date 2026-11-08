# Registro de Equipos de Videovigilancia

**Actividad Integradora 3 - Programación de Sistemas Web**
Universidad ECOTEC - Ingeniería en Sistemas Inteligentes
Estudiante: Andrés Reyes Silva

## Descripción

Módulo web en PHP con arquitectura MVC y base de datos MySQL/MariaDB
para registrar y consultar equipos de videovigilancia (cámaras,
grabadores y switches).

## Funcionalidades

- Registro de equipos con validación en el navegador y en el servidor.
- Consulta de los equipos registrados en una tabla responsiva.
- Control de IP duplicada (cada equipo tiene una IP única).

## Tecnologías

- PHP 8 con PDO
- MySQL / MariaDB
- HTML5, CSS3, JavaScript
- Bootstrap 5.3 (CDN)
- XAMPP como entorno local

## Estructura

```
config/        Configuración y conexión a la base de datos
controllers/   Controlador (recibe peticiones y valida)
models/        Modelo (consultas a la base de datos)
vistas/        Vista (HTML que ve el usuario)
database/      Script SQL de creación
public/        CSS y JavaScript
index.php      Punto de entrada del sistema
```

## Requisitos

- XAMPP 8.x (Apache + MariaDB + PHP)
- Git

## Instalación local

1. Clonar el repositorio dentro de la carpeta `htdocs` de XAMPP:
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/reyes-andres/AI3_DisenoWeb_AndresReyes.git
   ```
2. Abrir el Panel de Control de XAMPP e iniciar **Apache** y **MySQL**.
3. Entrar a `http://localhost/phpmyadmin`, abrir la pestaña **SQL**,
   pegar el contenido de `database/db_sistema_web.sql` y ejecutarlo.
4. Copiar `config/config.example.php` como `config/config.php`
   y ajustar usuario y clave si son diferentes (en XAMPP: `root` sin clave):
   ```bash
   cd AI3_DisenoWeb_AndresReyes
   copy config\config.example.php config\config.php
   ```
5. Abrir en el navegador:
   ```
   http://localhost/AI3_DisenoWeb_AndresReyes/
   ```

> Si Apache usa otro puerto (por ejemplo 8080), agregarlo a las URL:
> `http://localhost:8080/phpmyadmin` y `http://localhost:8080/AI3_DisenoWeb_AndresReyes/`

## Seguridad implementada

- **Inyección SQL:** todas las consultas usan sentencias preparadas de PDO.
- **XSS:** todos los datos se muestran con `htmlspecialchars()`.
- **Errores:** la conexión usa `try-catch`; el usuario solo ve un mensaje general.
- **Credenciales:** `config/config.php` está en `.gitignore` y no se sube al repositorio.
- **Validación:** en el navegador (HTML5 + JavaScript) y en el servidor (PHP).
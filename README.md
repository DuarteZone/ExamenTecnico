# TaskFlow API

API RESTful para gestión colaborativa de tareas, construida en PHP 8+ sin frameworks, siguiendo arquitectura MVC y buenas prácticas modernas.

---

## 📋 Contenido

- [Descripción](#descripción)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Migraciones y Seeders](#migraciones-y-seeders)
- [Ejecutar el proyecto](#ejecutar-el-proyecto)
- [Endpoints](#endpoints)
- [Testing](#testing)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Notas adicionales](#notas-adicionales)

---

## Descripción

TaskFlow es una API REST para administrar tareas con usuarios autenticados, donde se puede:

- Registrar y autenticar usuarios (JWT).
- CRUD de tareas con campos: título, descripción, estado, fecha de vencimiento.
- Filtrado y ordenación de tareas.
- Auditoría de cambios de estado en tareas.
- Testing con PHPUnit.
- Migraciones y Seeders para inicializar base de datos.
- Documentación clara y buenas prácticas SOLID.

---

## Requisitos

- PHP 8.0 o superior
- MySQL 5.7+ o MariaDB (puedes usar SQLite para testing)
- Composer
- Extensiones PHP: PDO, mbstring, json
- (Opcional) Docker

---

## Instalación

1. Clona el repositorio

```bash
git clone https://github.com/tu-usuario/taskflow-api.git
cd taskflow-api



## instala las dependencias

```bash
composer install

##cre el archivo .env

```bash
cp .env.example .env

## edita el archivo .env y configura tus credenciales de base de datos

```bash
nano .env
# o usa tu editor favorito  
APP_NAME=TaskFlow
APP_ENV=local
DB_HOST=127.0.0.1
DB_NAME=taskflow
DB_USER=root
DB_PASS=tu_password


## Una vez configurado, puedes correr las migraciones y seeders para inicializar la base de datos:

```bash
php database/reset.php

## Esto creará la base de datos y las tablas necesarias, además de insertar datos de ejemplo.

##ejecuta el servidor PHP integrado para probar la API:

```bash
php -S localhost:8000 -t public

## Ahora puedes acceder a la API en http://localhost:8000

## Endpoints principales:
| Método | Ruta              | Descripción                                         |
| ------ | ----------------- | --------------------------------------------------- |
| POST   | `/api/register`   | Registro de usuario                                 |
| POST   | `/api/login`      | Login y obtención de token JWT                      |
| GET    | `/api/tasks`      | Listar tareas del usuario autenticado (con filtros) |
| POST   | `/api/tasks`      | Crear nueva tarea                                   |
| GET    | `/api/tasks/{id}` | Obtener detalle de tarea                            |
| PUT    | `/api/tasks/{id}` | Actualizar tarea                                    |
| DELETE | `/api/tasks/{id}` | Eliminar tarea                                      |
| POST   | `/api/tasks/{id}/status` | Cambiar estado de tarea (con auditoría) |

## Autenticación Todas las rutas excepto /api/register y /api/login requieren un header HTTP:
    ```bash
    curl -X POST http://localhost:8000/api/register \
    -H "Content-Type: application/json" \
    -d '{"email": "user@example.com", "name": "User", "password": "123456"}'
## la salida será un token JWT que debes incluir en el header Authorization para las demás peticiones:
    ```bash
    Authorization: Bearer tu_token_jwt

## Testing
##Se utilizan tests con PHPUnit:
##Instala PHPUnit si no está instalado:
```bash
composer require --dev phpunit/phpunit
## Ejecuta los tests se creo el script `tests/bootstrap.php` para cargar el entorno y las dependencias y se corre con el script de PHPUnit:
```bash
   composer test
## Esto ejecutará todos los tests en la carpeta `tests/` y mostrará los resultados.


## Estructura del proyecto

```
taskflow-api/
├── app/                # Lógica de negocio (MVC)
│   ├── Controllers/    # Controladores de la API
│   ├── Models/         # Modelos de datos
│   ├── Services/       # Servicios de negocio
│   └── Core/           # Clases base y utilidades
├── config/             # Configuración de la aplicación
├── database/           # Migraciones y seeders
├── public/             # Punto de entrada (index.php)
├── tests/              # Tests unitarios y funcionales
├── vendor/             # Dependencias de Composer
├── .env                # Variables de entorno
├── .gitignore           # Archivos ignorados por Git
├── composer.json       # Dependencias del proyecto
├── composer.lock       # Bloqueo de dependencias
└── README.md           # Documentación del proyecto
└── phpunit.xml.dist    # Configuración de PHPUnit

```

---

## Notas adicionales    
- La API sigue buenas prácticas REST y SOLID.
- Se recomienda usar Postman o similar para probar los endpoints, YO ocupe curl para las pruebas.
- La autenticación se maneja con JWT, asegurando que las rutas protegidas solo sean accesibles para usuarios autenticados.
- ejemplo de curl para probar la API:
```bash
curl -X GET http://localhost:8000/api/tasks \
    -H "Authorization: Bearer tu_token_jwt"
## Contribuciones
Las contribuciones son bienvenidas. Por favor, abre un issue o pull request si encuentras algún error o tienes una mejora.
## Licencia
MIA hahaah




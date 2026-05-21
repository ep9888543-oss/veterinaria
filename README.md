# Sistema de Gestión para Veterinaria

Este proyecto es un sistema web de gestión para clínicas veterinarias construido con **Laravel 11**. Cuenta con un sistema de autenticación por roles y paneles de control separados para administradores y personal veterinario, integrando la plantilla **SB Admin 2** (Bootstrap).

## 🚀 Características Actuales

- **Autenticación Segura:** Sistema de Login y Logout personalizado.
- **Gestión de Roles:** Diferenciación entre usuarios `administrador` y `veterinario`.
- **Dashboards Independientes:**
  - **Administrador:** Panel de control con métricas globales, alertas y gestión del sistema.
  - **Veterinario:** Panel enfocado en la gestión clínica (pacientes, consultas, propietarios).
- **Interfaz Moderna:** Integración completa con SB Admin 2, incluyendo menús laterales (sidebar) y barras superiores (topbar) dinámicas por rol.

## 📋 Requisitos Previos

Asegúrate de tener instalados los siguientes componentes en tu entorno local:
- PHP >= 8.2
- Composer
- Node.js & NPM
- Servidor de base de datos (MySQL, MariaDB o SQLite)

## 🛠️ Instrucciones de Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/mc670747-eng/veterinaria.git
   cd veterinaria
   ```

2. **Instalar dependencias de PHP y Node:**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Configurar el entorno:**
   Copia el archivo de ejemplo para crear tu configuración local:
   ```bash
   cp .env.example .env
   ```
   Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

4. **Configurar la Base de Datos:**
   Edita el archivo `.env` con tus credenciales de base de datos. Ejemplo para MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=veterinaria
   DB_USERNAME=root
   DB_PASSWORD=tu_contraseña
   ```

5. **Migrar y poblar la base de datos (Seeders):**
   Ejecuta las migraciones y los seeders para crear las tablas y los usuarios de prueba:
   ```bash
   php artisan migrate --seed
   ```

6. **Iniciar el servidor local:**
   ```bash
   php artisan serve
   ```
   *Opcional: Si necesitas compilar assets en tiempo real, ejecuta `npm run dev` en otra terminal.*

## 🔑 Credenciales de Prueba

Al ejecutar los seeders, se crean automáticamente los siguientes usuarios para que puedas probar los diferentes entornos:

| Rol | Correo Electrónico | Contraseña | Destino tras Login |
| :--- | :--- | :--- | :--- |
| **Administrador** | `admin@admin.com` | `admin` | `/admin/dashboard` |
| **Veterinario** | `vet@vet.com` | `vet` | `/home` |

## 🏗️ Estructura Destacada

- `app/Http/Middleware/RoleMiddleware.php`: Middleware encargado de proteger las rutas según el rol.
- `database/seeders/UserSeeder.php`: Archivo donde se configuran los usuarios iniciales.
- `resources/views/layouts/`: Contiene los layouts base (`main.blade.php`, `admin.blade.php`, `auth.blade.php`) y sus respectivos partials.

---
*Proyecto en desarrollo.*

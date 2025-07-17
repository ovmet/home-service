# Home Services CRM

Este proyecto es un sistema CRM (Customer Relationship Management) para la gestión de servicios técnicos a domicilio, desarrollado en Laravel.

## Características

- Gestión de técnicos, clientes, dispositivos y órdenes de reparación.
- Administración de marcas y tipos de dispositivos.
- Control de estados de reparación.
- Exportación de órdenes de reparación a PDF.
- Panel de administración para la empresa.

## Estructura principal

- **Técnicos:** Alta, baja y modificación de técnicos.
- **Clientes:** Registro y gestión de clientes.
- **Dispositivos:** Inventario y asignación de dispositivos a clientes.
- **Órdenes de reparación:** Creación, seguimiento y cierre de órdenes.
- **Marcas y tipos de dispositivos:** Catálogo editable.
- **Estados:** Control de estados de las órdenes.
- **Empresa:** Edición de datos de la empresa.

## Instalación

1. Clona el repositorio:
   ```sh
   git clone https://github.com/ovmet/home-service.git
   cd home-service
   ```

2. Instala las dependencias de PHP:
   ```sh
   composer install
   ```

3. Copia el archivo de entorno y configura tus variables:
   ```sh
   cp .env.example .env
   ```
   Edita `.env` con tus datos de base de datos y otros parámetros.

4. Genera la clave de la aplicación:
   ```sh
   php artisan key:generate
   ```

5. Ejecuta las migraciones y seeders:
   ```sh
   php artisan migrate --seed
   ```

6. Inicia el servidor de desarrollo:
   ```sh
   php artisan serve
   ```

7. Accede a la aplicación en [http://localhost:8000](http://localhost:8000)

## Requisitos

- PHP >= 8.1
- Composer
- MySQL o MariaDB
- Node.js y npm (opcional, para assets front-end)

## Contribución

¡Las contribuciones son bienvenidas! Por favor, abre un issue o pull request para sugerencias o mejoras.

## Licencia

Este proyecto está bajo la licencia MIT.

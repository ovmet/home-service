# 🏠 Home Services CRM

Un sistema completo de gestión de servicios técnicos a domicilio desarrollado en **Laravel 10** con interfaz moderna y funcionalidades avanzadas.

## 📋 Descripción

Home Services CRM es una aplicación web diseñada para empresas que ofrecen servicios técnicos a domicilio. Permite gestionar técnicos, clientes, dispositivos, órdenes de reparación y generar reportes completos.

## ✨ Características Principales

### 🔧 Gestión de Servicios
- **Técnicos:** Registro, edición y gestión completa de técnicos
- **Clientes:** Base de datos de clientes con información detallada
- **Dispositivos:** Inventario de dispositivos con marcas y tipos
- **Órdenes de Reparación:** Creación, seguimiento y cierre de órdenes
- **Estados:** Control de estados de reparación en tiempo real

### 📊 Reportes y Exportación
- Generación de reportes por fechas
- Exportación de órdenes a PDF
- Búsqueda avanzada de órdenes
- Reportes de rendimiento

### 🏢 Gestión Empresarial
- Configuración de datos de la empresa
- Panel de administración intuitivo
- Gestión de marcas y tipos de dispositivos
- Importación masiva de clientes

## 🚀 Instalación

### Opción 1: Instalación Tradicional

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/ovmet/home-service.git
   cd home-service
   ```

2. **Instala las dependencias:**
   ```bash
   composer install
   npm install
   ```

3. **Configura el entorno:**
   ```bash
   cp .env.example .env
   ```
   Edita `.env` con tus datos de base de datos y configuración.

4. **Genera la clave de aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Ejecuta las migraciones y seeders:**
   ```bash
   php artisan migrate --seed
   ```

6. **Compila los assets:**
   ```bash
   npm run build
   ```

7. **Inicia el servidor:**
   ```bash
   php artisan serve
   ```

### Opción 2: Instalación con Docker

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/ovmet/home-service.git
   cd home-service
   ```

2. **Ejecuta con Docker Compose:**
   ```bash
   docker-compose up -d
   ```

3. **Instala dependencias dentro del contenedor:**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app npm install
   docker-compose exec app npm run build
   ```

4. **Configura la aplicación:**
   ```bash
   docker-compose exec app cp .env.example .env
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate --seed
   ```

5. **Accede a la aplicación:**
   - Web: http://localhost:8080
   - Base de datos: localhost:3306

## 📁 Estructura del Proyecto

```
home-services/
├── app/
│   ├── Http/Controllers/     # Controladores de la aplicación
│   ├── Models/              # Modelos Eloquent
│   └── Imports/             # Importadores de datos
├── database/
│   ├── migrations/          # Migraciones de base de datos
│   ├── seeders/            # Seeders para datos de prueba
│   └── factories/          # Factories para testing
├── resources/
│   ├── views/              # Vistas Blade
│   ├── css/                # Estilos CSS
│   └── js/                 # JavaScript
├── routes/
│   └── web.php             # Rutas web
├── docker/                 # Configuración Docker
├── public/                 # Archivos públicos
└── storage/                # Almacenamiento de archivos
```

## 🗄️ Base de Datos

### Tablas Principales:
- **users** - Usuarios del sistema
- **companies** - Datos de la empresa
- **technicians** - Técnicos
- **clients** - Clientes
- **brands** - Marcas de dispositivos
- **device_types** - Tipos de dispositivos
- **devices** - Dispositivos
- **statuses** - Estados de reparación
- **repair_orders** - Órdenes de reparación

## 🛠️ Tecnologías Utilizadas

- **Backend:** Laravel 10, PHP 8.1+
- **Frontend:** Blade, CSS3, JavaScript
- **Base de Datos:** MySQL/MariaDB
- **Servidor Web:** Apache/Nginx
- **Contenedores:** Docker & Docker Compose
- **Gestión de Paquetes:** Composer, npm

## 📱 Funcionalidades Detalladas

### 👥 Gestión de Técnicos
- Registro con información completa
- Asignación a órdenes de reparación
- Historial de trabajos realizados
- Gestión de disponibilidad

### 👤 Gestión de Clientes
- Registro con datos personales
- Historial de servicios
- Información de contacto
- Importación masiva desde Excel

### 📱 Gestión de Dispositivos
- Catálogo de marcas y tipos
- Asignación a clientes
- Historial de reparaciones
- Control de inventario

### 🔧 Órdenes de Reparación
- Creación con información detallada
- Seguimiento de estados
- Generación de PDF
- Búsqueda y filtros avanzados

## 🔧 Configuración

### Variables de Entorno (.env)
```env
APP_NAME="Home Services CRM"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=home_services
DB_USERNAME=root
DB_PASSWORD=
```

### Configuración Docker
- **Puerto Web:** 8080
- **Puerto Base de Datos:** 3306
- **Volumen de Datos:** ./storage:/var/www/html/storage

## 📊 Reportes Disponibles

1. **Reporte por Fechas:** Filtrado por rango de fechas
2. **Reporte de Técnicos:** Rendimiento por técnico
3. **Reporte de Estados:** Distribución de estados
4. **Exportación PDF:** Órdenes en formato PDF

## 🚀 Despliegue

### Producción con Docker
```bash
# Construir imagen de producción
docker build -t home-services .

# Ejecutar contenedor
docker run -d -p 80:80 home-services
```

### Configuración de Servidor Web
- Apache/Nginx configurado
- SSL/HTTPS recomendado
- Optimización de caché
- Compresión de assets

## 🤝 Contribución

1. Fork el proyecto
2. Crea un branch para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push al branch (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

- **Issues:** [GitHub Issues](https://github.com/ovmet/home-service/issues)
- **Documentación:** [Wiki del Proyecto](https://github.com/ovmet/home-service/wiki)
- **Email:** soporte@homeservices.com

## 🙏 Agradecimientos

- Laravel Framework
- Bootstrap CSS Framework
- Comunidad de desarrolladores
- Contribuidores del proyecto

---

**Desarrollado con ❤️ para empresas de servicios técnicos**

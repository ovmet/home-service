# 🚀 CRM Home Services - Guía de Instalación

## 📋 Resumen

Este es un sistema CRM para gestión de servicios técnicos a domicilio desarrollado en **Laravel 12** con **Tailwind CSS**. El sistema permite gestionar técnicos, clientes, equipos y órdenes de reparación.

## 🎯 Opciones de Instalación

### 1. ⚡ Instalación Rápida (Recomendada)

#### Para Windows:
```cmd
install.bat
```

#### Para Linux/Mac:
```bash
./install.sh
```

### 2. 🐳 Instalación con Docker (Más Fácil)

```bash
./docker-install.sh
```

### 3. 📝 Instalación Manual

Sigue la guía completa en [INSTALACION.md](INSTALACION.md)

## 🔧 Requisitos Previos

### Software Necesario:
- **PHP 8.2+**
- **Composer**
- **Node.js 18+ y npm**
- **Git**

### Para Docker:
- **Docker Desktop**
- **Docker Compose**

## 🚀 Instalación Paso a Paso

### Opción 1: Instalación Automática

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/ovmet/home-service.git
   cd home-service
   ```

2. **Ejecutar script de instalación:**
   ```bash
   # Windows
   install.bat
   
   # Linux/Mac
   ./install.sh
   ```

3. **Iniciar servidor:**
   ```bash
   php artisan serve
   ```

4. **Acceder al sistema:**
   - URL: http://localhost:8000
   - Email: admin@example.com
   - Password: password

### Opción 2: Instalación con Docker

1. **Clonar y ejecutar:**
   ```bash
   git clone https://github.com/ovmet/home-service.git
   cd home-service
   ./docker-install.sh
   ```

2. **Acceder al sistema:**
   - URL: http://localhost:8000
   - Email: admin@example.com
   - Password: password

## 🎨 Solución de Problemas de Estilos

Si el sistema se ve sin estilos CSS, ejecuta:

```bash
# Instalar dependencias
npm install

# Compilar assets
npm run build

# O para desarrollo
npm run dev
```

Ver guía completa en [SOLUCION_ESTILOS.md](SOLUCION_ESTILOS.md)

## 📁 Estructura del Proyecto

```
home-services/
├── app/                    # Lógica de la aplicación
├── resources/             # Vistas y assets
├── database/              # Migraciones y seeders
├── routes/                # Definición de rutas
├── public/                # Archivos públicos
├── storage/               # Logs y archivos temporales
├── config/                # Configuración
├── install.sh             # Script de instalación Linux/Mac
├── install.bat            # Script de instalación Windows
├── docker-install.sh      # Script de instalación Docker
├── docker-compose.yml     # Configuración Docker
└── INSTALACION.md         # Guía completa de instalación
```

## 🔍 Características del Sistema

- ✅ **Gestión de Técnicos:** Alta, baja y modificación
- ✅ **Gestión de Clientes:** Registro y seguimiento
- ✅ **Gestión de Equipos:** Inventario y asignación
- ✅ **Órdenes de Reparación:** Creación y seguimiento
- ✅ **Reportes:** Exportación a PDF
- ✅ **Panel de Administración:** Configuración de empresa

## 🛠️ Comandos Útiles

### Desarrollo:
```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en tiempo real
npm run dev

# Ver logs
tail -f storage/logs/laravel.log
```

### Producción:
```bash
# Compilar assets optimizados
npm run build

# Cache de configuración
php artisan config:cache

# Cache de rutas
php artisan route:cache
```

### Docker:
```bash
# Ver logs
docker-compose logs -f

# Detener servicios
docker-compose down

# Reiniciar
docker-compose restart
```

## 🗄️ Base de Datos

### SQLite (Por defecto):
- Archivo: `database/database.sqlite`
- No requiere configuración adicional

### MySQL/MariaDB:
1. Crear base de datos
2. Configurar `.env`
3. Ejecutar migraciones

## 🔐 Seguridad

### Datos de Acceso Inicial:
- **Email:** admin@example.com
- **Password:** password

### Cambiar contraseña:
```bash
php artisan tinker
User::find(1)->update(['password' => Hash::make('nueva_password')]);
```

## 📊 Respaldos

### Respaldar Base de Datos:
```bash
# SQLite
cp database/database.sqlite backup_$(date +%Y%m%d).sqlite

# MySQL
mysqldump -u usuario -p home_services_crm > backup.sql
```

### Restaurar:
```bash
# SQLite
cp backup.sqlite database/database.sqlite

# MySQL
mysql -u usuario -p home_services_crm < backup.sql
```

## 🚨 Solución de Problemas

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Permission denied"
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: "Assets not found"
```bash
npm install && npm run build
```

### Error: "Database connection"
- Verificar configuración en `.env`
- Verificar que MySQL esté ejecutándose

## 📞 Soporte

### Logs del Sistema:
- Laravel: `storage/logs/laravel.log`
- Nginx: `/var/log/nginx/error.log`
- Apache: `/var/log/apache2/error.log`

### Comandos de Diagnóstico:
```bash
# Verificar configuración
php artisan config:show

# Verificar rutas
php artisan route:list

# Verificar cache
php artisan cache:clear
```

## 🔄 Actualizaciones

### Actualizar el Sistema:
```bash
# Obtener cambios
git pull origin main

# Actualizar dependencias
composer install
npm install

# Ejecutar migraciones
php artisan migrate

# Compilar assets
npm run build
```

## 📝 Licencia

Este proyecto está bajo la licencia MIT.

## 🤝 Contribución

¡Las contribuciones son bienvenidas! Por favor:

1. Fork el proyecto
2. Crear una rama para tu feature
3. Commit tus cambios
4. Push a la rama
5. Abrir un Pull Request

---

**¿Necesitas ayuda?** Revisa la documentación completa en [INSTALACION.md](INSTALACION.md) o [SOLUCION_ESTILOS.md](SOLUCION_ESTILOS.md) 
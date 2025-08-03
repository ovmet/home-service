# Guía de Instalación - CRM Home Services

## Requisitos Previos

### Software Necesario:
- **PHP 8.2 o superior**
- **Composer** (gestor de dependencias de PHP)
- **Node.js 18+ y npm** (para compilar assets)
- **Git** (para clonar el repositorio)

### Verificar Instalación:
```bash
# Verificar PHP
php --version

# Verificar Composer
composer --version

# Verificar Node.js
node --version
npm --version

# Verificar Git
git --version
```

## Instalación Paso a Paso

### 1. Clonar el Repositorio
```bash
git clone https://github.com/ovmet/home-service.git
cd home-service
```

### 2. Instalar Dependencias de PHP
```bash
composer install
```

### 3. Configurar Variables de Entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 4. Configurar Base de Datos
El sistema usa SQLite por defecto (archivo `database/database.sqlite`).

**Para usar MySQL/MariaDB:**
1. Editar `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=home_services_crm
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Ejecutar Migraciones y Seeders
```bash
# Crear tablas en la base de datos
php artisan migrate

# Insertar datos iniciales
php artisan db:seed
```

### 6. Instalar y Compilar Assets Frontend
```bash
# Instalar dependencias de Node.js
npm install

# Compilar assets para producción
npm run build
```

### 7. Configurar Permisos (Solo Linux/Mac)
```bash
# Dar permisos de escritura a storage y bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### 8. Iniciar el Servidor
```bash
# Servidor de desarrollo
php artisan serve

# O para producción (recomendado)
php artisan serve --host=0.0.0.0 --port=8000
```

### 9. Acceder al Sistema
Abrir navegador en: `http://localhost:8000`

## Script de Instalación Automática

Crear archivo `install.sh` (Linux/Mac) o `install.bat` (Windows):

### Para Linux/Mac (`install.sh`):
```bash
#!/bin/bash

echo "🚀 Iniciando instalación del CRM Home Services..."

# Verificar requisitos
echo "📋 Verificando requisitos..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP no está instalado"
    exit 1
fi

if ! command -v composer &> /dev/null; then
    echo "❌ Composer no está instalado"
    exit 1
fi

if ! command -v node &> /dev/null; then
    echo "❌ Node.js no está instalado"
    exit 1
fi

echo "✅ Requisitos verificados"

# Instalar dependencias PHP
echo "📦 Instalando dependencias PHP..."
composer install --no-interaction

# Configurar entorno
echo "⚙️ Configurando entorno..."
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generar clave
php artisan key:generate --no-interaction

# Ejecutar migraciones
echo "🗄️ Configurando base de datos..."
php artisan migrate --force

# Ejecutar seeders
echo "🌱 Insertando datos iniciales..."
php artisan db:seed --force

# Instalar dependencias Node.js
echo "📦 Instalando dependencias Node.js..."
npm install

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

# Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 775 storage bootstrap/cache

echo "✅ Instalación completada!"
echo "🌐 Accede a: http://localhost:8000"
echo "🚀 Para iniciar: php artisan serve"
```

### Para Windows (`install.bat`):
```batch
@echo off
echo 🚀 Iniciando instalación del CRM Home Services...

echo 📦 Instalando dependencias PHP...
composer install --no-interaction

echo ⚙️ Configurando entorno...
if not exist .env copy .env.example .env

echo 🔑 Generando clave de aplicación...
php artisan key:generate --no-interaction

echo 🗄️ Configurando base de datos...
php artisan migrate --force

echo 🌱 Insertando datos iniciales...
php artisan db:seed --force

echo 📦 Instalando dependencias Node.js...
npm install

echo 🎨 Compilando assets...
npm run build

echo ✅ Instalación completada!
echo 🌐 Accede a: http://localhost:8000
echo 🚀 Para iniciar: php artisan serve
pause
```

## Configuración para Producción

### 1. Configurar Servidor Web (Apache/Nginx)

**Apache (.htaccess ya incluido):**
```apache
<VirtualHost *:80>
    ServerName tu-dominio.com
    DocumentRoot /ruta/a/home-service/public
    
    <Directory /ruta/a/home-service/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Nginx:**
```nginx
server {
    listen 80;
    server_name tu-dominio.com;
    root /ruta/a/home-service/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 2. Optimizar para Producción
```bash
# Cache de configuración
php artisan config:cache

# Cache de rutas
php artisan route:cache

# Cache de vistas
php artisan view:cache

# Optimizar autoloader
composer install --optimize-autoloader --no-dev
```

## Solución de Problemas Comunes

### Error: "Class 'App\Http\Controllers\...' not found"
```bash
composer dump-autoload
```

### Error: "Permission denied" en storage
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"
- Verificar que MySQL esté ejecutándose
- Verificar configuración en `.env`

### Assets no se cargan
```bash
npm install
npm run build
```

### Error de memoria en PHP
Aumentar `memory_limit` en `php.ini`:
```ini
memory_limit = 512M
```

## Datos de Acceso Inicial

Después de ejecutar los seeders, puedes acceder con:
- **Email:** admin@example.com
- **Password:** password

## Respaldos y Migración

### Respaldar Base de Datos
```bash
# SQLite
cp database/database.sqlite backup_$(date +%Y%m%d).sqlite

# MySQL
mysqldump -u usuario -p home_services_crm > backup_$(date +%Y%m%d).sql
```

### Migrar a Otro Servidor
1. Copiar todo el proyecto
2. Ejecutar `composer install`
3. Configurar `.env` con nuevos datos
4. Ejecutar `php artisan migrate`
5. Compilar assets: `npm run build`

## Soporte

Para problemas técnicos:
1. Verificar logs en `storage/logs/laravel.log`
2. Ejecutar `php artisan config:clear`
3. Verificar permisos de archivos
4. Revisar configuración de `.env` 
@echo off
chcp 65001 >nul
echo 🚀 Iniciando instalación del CRM Home Services...

echo 📋 Verificando requisitos...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP no está instalado
    echo 💡 Instala PHP 8.2 o superior
    pause
    exit /b 1
)

composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer no está instalado
    echo 💡 Instala Composer desde https://getcomposer.org/
    pause
    exit /b 1
)

node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js no está instalado
    echo 💡 Instala Node.js desde https://nodejs.org/
    pause
    exit /b 1
)

echo ✅ Requisitos verificados

echo 📦 Instalando dependencias PHP...
composer install --no-interaction
if %errorlevel% neq 0 (
    echo ❌ Error al instalar dependencias PHP
    pause
    exit /b 1
)

echo ⚙️ Configurando entorno...
if not exist .env (
    if exist .env.example (
        copy .env.example .env >nul
        echo ✅ Archivo .env creado desde .env.example
    ) else (
        echo ❌ No se encontró .env.example
        pause
        exit /b 1
    )
) else (
    echo ✅ Archivo .env ya existe
)

echo 🔑 Generando clave de aplicación...
php artisan key:generate --no-interaction
if %errorlevel% neq 0 (
    echo ❌ Error al generar clave de aplicación
    pause
    exit /b 1
)

echo 🗄️ Configurando base de datos...
php artisan migrate --force
if %errorlevel% neq 0 (
    echo ❌ Error al ejecutar migraciones
    pause
    exit /b 1
)

echo 🌱 Insertando datos iniciales...
php artisan db:seed --force
if %errorlevel% neq 0 (
    echo ⚠️ Advertencia: Error al ejecutar seeders
)

echo 📦 Instalando dependencias Node.js...
npm install
if %errorlevel% neq 0 (
    echo ❌ Error al instalar dependencias Node.js
    pause
    exit /b 1
)

echo 🎨 Compilando assets...
npm run build
if %errorlevel% neq 0 (
    echo ❌ Error al compilar assets
    pause
    exit /b 1
)

echo 🧹 Limpiando cache...
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo ✅ Instalación completada exitosamente!
echo.
echo 🌐 Para acceder al sistema:
echo    URL: http://localhost:8000
echo.
echo 🚀 Para iniciar el servidor:
echo    php artisan serve
echo.
echo 📧 Datos de acceso inicial:
echo    Email: admin@example.com
echo    Password: password
echo.
echo 💡 Para producción, configura un servidor web (Apache/Nginx)
echo    y ejecuta: php artisan config:cache
echo.
pause 
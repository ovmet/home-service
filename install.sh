#!/bin/bash

echo "🚀 Iniciando instalación del CRM Home Services..."

# Verificar requisitos
echo "📋 Verificando requisitos..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP no está instalado"
    echo "💡 Instala PHP 8.2 o superior"
    exit 1
fi

if ! command -v composer &> /dev/null; then
    echo "❌ Composer no está instalado"
    echo "💡 Instala Composer desde https://getcomposer.org/"
    exit 1
fi

if ! command -v node &> /dev/null; then
    echo "❌ Node.js no está instalado"
    echo "💡 Instala Node.js desde https://nodejs.org/"
    exit 1
fi

echo "✅ Requisitos verificados"

# Verificar versión de PHP
PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo "📋 PHP versión: $PHP_VERSION"

# Instalar dependencias PHP
echo "📦 Instalando dependencias PHP..."
composer install --no-interaction

if [ $? -ne 0 ]; then
    echo "❌ Error al instalar dependencias PHP"
    exit 1
fi

# Configurar entorno
echo "⚙️ Configurando entorno..."
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
        echo "✅ Archivo .env creado desde .env.example"
    else
        echo "❌ No se encontró .env.example"
        exit 1
    fi
else
    echo "✅ Archivo .env ya existe"
fi

# Generar clave
echo "🔑 Generando clave de aplicación..."
php artisan key:generate --no-interaction

if [ $? -ne 0 ]; then
    echo "❌ Error al generar clave de aplicación"
    exit 1
fi

# Ejecutar migraciones
echo "🗄️ Configurando base de datos..."
php artisan migrate --force

if [ $? -ne 0 ]; then
    echo "❌ Error al ejecutar migraciones"
    exit 1
fi

# Ejecutar seeders
echo "🌱 Insertando datos iniciales..."
php artisan db:seed --force

if [ $? -ne 0 ]; then
    echo "⚠️ Advertencia: Error al ejecutar seeders"
fi

# Instalar dependencias Node.js
echo "📦 Instalando dependencias Node.js..."
npm install

if [ $? -ne 0 ]; then
    echo "❌ Error al instalar dependencias Node.js"
    exit 1
fi

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

if [ $? -ne 0 ]; then
    echo "❌ Error al compilar assets"
    exit 1
fi

# Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || echo "⚠️ No se pudieron configurar permisos (puede ser normal en Windows)"

# Limpiar cache
echo "🧹 Limpiando cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo ""
echo "✅ Instalación completada exitosamente!"
echo ""
echo "🌐 Para acceder al sistema:"
echo "   URL: http://localhost:8000"
echo ""
echo "🚀 Para iniciar el servidor:"
echo "   php artisan serve"
echo ""
echo "📧 Datos de acceso inicial:"
echo "   Email: admin@example.com"
echo "   Password: password"
echo ""
echo "💡 Para producción, configura un servidor web (Apache/Nginx)"
echo "   y ejecuta: php artisan config:cache" 
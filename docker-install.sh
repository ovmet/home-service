#!/bin/bash

echo "🐳 Iniciando instalación del CRM Home Services con Docker..."

# Verificar si Docker está instalado
if ! command -v docker &> /dev/null; then
    echo "❌ Docker no está instalado"
    echo "💡 Instala Docker desde https://docker.com/"
    exit 1
fi

# Verificar si Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose no está instalado"
    echo "💡 Instala Docker Compose desde https://docs.docker.com/compose/install/"
    exit 1
fi

echo "✅ Docker y Docker Compose verificados"

# Crear archivo .env si no existe
if [ ! -f .env ]; then
    echo "⚙️ Creando archivo .env..."
    cat > .env << EOF
APP_NAME="CRM Home Services"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=home_services_crm
DB_USERNAME=home_services
DB_PASSWORD=home_services

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="\${APP_NAME}"
VITE_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="\${PUSHER_HOST}"
VITE_PUSHER_PORT="\${PUSHER_PORT}"
VITE_PUSHER_SCHEME="\${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"
EOF
    echo "✅ Archivo .env creado"
fi

# Construir y levantar contenedores
echo "🐳 Construyendo contenedores..."
docker-compose up -d --build

if [ $? -ne 0 ]; then
    echo "❌ Error al construir contenedores"
    exit 1
fi

# Esperar a que la base de datos esté lista
echo "⏳ Esperando a que la base de datos esté lista..."
sleep 30

# Ejecutar migraciones y seeders
echo "🗄️ Configurando base de datos..."
docker-compose exec app php artisan migrate --force

if [ $? -ne 0 ]; then
    echo "❌ Error al ejecutar migraciones"
    exit 1
fi

echo "🌱 Insertando datos iniciales..."
docker-compose exec app php artisan db:seed --force

if [ $? -ne 0 ]; then
    echo "⚠️ Advertencia: Error al ejecutar seeders"
fi

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
docker-compose exec app php artisan key:generate --no-interaction

# Limpiar cache
echo "🧹 Limpiando cache..."
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear

echo ""
echo "✅ Instalación con Docker completada exitosamente!"
echo ""
echo "🌐 Para acceder al sistema:"
echo "   URL: http://localhost:8000"
echo ""
echo "📧 Datos de acceso inicial:"
echo "   Email: admin@example.com"
echo "   Password: password"
echo ""
echo "🐳 Comandos útiles:"
echo "   Ver logs: docker-compose logs -f"
echo "   Detener: docker-compose down"
echo "   Reiniciar: docker-compose restart"
echo ""
echo "💡 Para desarrollo local:"
echo "   docker-compose exec app php artisan serve --host=0.0.0.0" 
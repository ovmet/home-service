# Configuración de Assets Offline

## Problema Resuelto

El proyecto ahora funciona completamente offline sin depender de CDNs externos. Esto soluciona el problema de que las vistas se veían sin formato cuando no había conexión a internet.

## Solución Implementada

### 1. Assets Locales
- **Bootstrap CSS y JS** descargados localmente
- **Compilación con Vite** para optimización
- **Sistema de fallback inteligente** que detecta si los assets locales están disponibles

### 2. Configuración de Archivos

#### `resources/css/app.css`
```css
/* Importar Bootstrap localmente */
@import 'bootstrap/dist/css/bootstrap.min.css';

/* Importar Tailwind CSS */
@import 'tailwindcss';

/* Estilos personalizados adicionales */
```

#### `resources/js/app.js`
```javascript
import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
```

#### `resources/views/layouts/app.blade.php`
```php
<!-- Assets con fallback inteligente -->
@if(app()->environment('local'))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    @if(App\Helpers\AssetHelper::hasLocalAssets())
        <link href="{{ asset('build/assets/app-C8_NOOnd.css') }}" rel="stylesheet">
        <script src="{{ asset('build/assets/app-D1IG_nlC.js') }}" defer></script>
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    @endif
@endif
```

### 3. Helper de Assets

#### `app/Helpers/AssetHelper.php`
- Detecta automáticamente si los assets locales están disponibles
- Proporciona fallback a CDN si es necesario
- Permite control granular sobre qué assets usar

### 4. Configuración

#### `config/assets.php`
```php
return [
    'local_assets' => [
        'css' => [
            'bootstrap' => 'build/assets/app-C8_NOOnd.css',
        ],
        'js' => [
            'bootstrap' => 'build/assets/app-D1IG_nlC.js',
        ],
    ],
    'fallback_cdn' => [
        'bootstrap_css' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        'bootstrap_js' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
    ],
    'offline_mode' => env('ASSETS_OFFLINE_MODE', true),
];
```

## Cómo Funciona

### Modo Desarrollo (Local)
- Usa Vite para hot reload
- Assets compilados en tiempo real
- Mejor experiencia de desarrollo

### Modo Producción
1. **Primera opción:** Assets locales compilados
2. **Segunda opción:** CDN como fallback
3. **Detección automática** de disponibilidad

## Comandos Útiles

### Compilar Assets
```bash
npm run build
```

### Desarrollo con Hot Reload
```bash
npm run dev
```

### Verificar Assets Locales
```php
App\Helpers\AssetHelper::hasLocalAssets()
```

## Ventajas

✅ **Funciona offline** - No depende de internet
✅ **Rendimiento mejorado** - Assets locales más rápidos
✅ **Fallback inteligente** - Si fallan los locales, usa CDN
✅ **Configuración flexible** - Control total sobre assets
✅ **Optimización automática** - Vite optimiza los assets

## Troubleshooting

### Si los estilos no se cargan:
1. Verificar que `npm run build` se ejecutó correctamente
2. Verificar que los archivos existen en `public/build/assets/`
3. Verificar permisos de archivos
4. Limpiar caché: `php artisan cache:clear`

### Para forzar modo offline:
```bash
ASSETS_OFFLINE_MODE=true php artisan serve
```

### Para usar CDN (no recomendado):
```bash
ASSETS_OFFLINE_MODE=false php artisan serve
```

## Archivos Modificados

- `resources/views/layouts/app.blade.php`
- `resources/css/app.css`
- `resources/js/app.js`
- `app/Helpers/AssetHelper.php`
- `app/Providers/AppServiceProvider.php`
- `config/assets.php`
- `package.json` (dependencias agregadas)

## Dependencias Agregadas

```json
{
  "bootstrap": "^5.3.0"
}
``` 
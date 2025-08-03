<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRM Reparaciones')</title>
    
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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">CRM Reparaciones</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="configuracionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Configuración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="configuracionDropdown">
                            <li><a class="dropdown-item" href="/company">Empresa</a></li>
                            <li><a class="dropdown-item" href="/technicians">Técnicos</a></li>
                            <li><a class="dropdown-item" href="/clients">Clientes</a></li>
                            <li><a class="dropdown-item" href="/statuses">Status</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="equiposDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Equipos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="equiposDropdown">
                            <li><a class="dropdown-item" href="/devices">Equipos</a></li>
                            <li><a class="dropdown-item" href="/device-types">Tipos de Equipo</a></li>
                            <li><a class="dropdown-item" href="/brands">Marcas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/repair-orders">Órdenes de Reparación</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html> 
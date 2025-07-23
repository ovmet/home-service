<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicios (Foráneo/Taller)</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
        th { background: #eee; }
        .header { margin-bottom: 10px; }
        .header .empresa { font-size: 18px; font-weight: bold; }
        .header .fecha { font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <div class="empresa">
            {{ \App\Models\Company::first()->name ?? 'CRM Reparaciones' }}
        </div>
        <div class="fecha">
            Fecha de impresión: {{ date('d/m/Y H:i') }}
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID Orden</th>
                <th>Cliente</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Tipo de equipo</th>
                <th>Falla</th>
            </tr>
        </thead>
        <tbody>
            @forelse($repairOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->device->client->name ?? '-' }}</td>
                <td>{{ $order->device->client->address ?? '-' }}</td>
                <td>{{ $order->device->client->phone ?? '-' }}</td>
                <td>{{ $order->device->deviceType->name ?? '-' }}</td>
                <td>{{ $order->description }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;">No hay resultados para los filtros seleccionados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html> 
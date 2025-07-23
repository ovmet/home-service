@extends('layouts.app')

@section('content')
<style>
@media print {
    .no-print, form, h1 { display: none !important; }
    .print-header { display: block !important; }
}
.print-header { display: none; margin-bottom: 10px; }
</style>
<div class="container">
    <div class="print-header">
        <div style="font-size:18px;font-weight:bold;">
            {{ \App\Models\Company::first()->name ?? 'CRM Reparaciones' }}
        </div>
        <div style="font-size:12px;color:#555;">
            Fecha de impresión: {{ date('d/m/Y H:i') }}
        </div>
    </div>
    <h1 class="mb-4">Reporte de Servicios (Foráneo/Taller)</h1>
    <form method="GET" action="{{ route('repair-orders.reporte.foraneo-taller') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="entry_date_from" class="form-label">Desde fecha de entrada</label>
            <input type="date" name="entry_date_from" id="entry_date_from" class="form-control" value="{{ request('entry_date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="entry_date_to" class="form-label">Hasta fecha de entrada</label>
            <input type="date" name="entry_date_to" id="entry_date_to" class="form-control" value="{{ request('entry_date_to') }}">
        </div>
        <div class="col-md-3">
            <label for="service_location" class="form-label">Ubicación</label>
            <select name="service_location" id="service_location" class="form-select">
                <option value="">Todas</option>
                <option value="foraneo" {{ request('service_location') == 'foraneo' ? 'selected' : '' }}>Foráneo</option>
                <option value="taller" {{ request('service_location') == 'taller' ? 'selected' : '' }}>En taller</option>
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
    <div class="mb-3 d-flex gap-2 no-print">
        <button class="btn btn-secondary" onclick="window.print()">Imprimir</button>
        <a href="{{ route('repair-orders.reporte.foraneo-taller.pdf', request()->all()) }}" class="btn btn-danger" target="_blank">Exportar PDF</a>
    </div>
    <table class="table table-bordered">
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
                <td colspan="6" class="text-center">No hay resultados para los filtros seleccionados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 
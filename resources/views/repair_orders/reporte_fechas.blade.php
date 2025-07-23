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
    <h1 class="mb-4">Reporte de Órdenes por Fechas</h1>
    <form method="GET" action="{{ route('repair-orders.reporte.fechas') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="entry_date_from" class="form-label">Desde fecha de recepción</label>
            <input type="date" name="entry_date_from" id="entry_date_from" class="form-control" value="{{ request('entry_date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="entry_date_to" class="form-label">Hasta fecha de recepción</label>
            <input type="date" name="entry_date_to" id="entry_date_to" class="form-control" value="{{ request('entry_date_to') }}">
        </div>
        <div class="col-md-3">
            <label for="technician_id" class="form-label">Técnico</label>
            <select name="technician_id" id="technician_id" class="form-select">
                <option value="">Todos</option>
                @foreach($technicians as $tech)
                    <option value="{{ $tech->id }}" {{ request('technician_id') == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="client_id" class="form-label">Cliente</label>
            <select name="client_id" id="client_id" class="form-select">
                <option value="">Todos</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
    <div class="mb-3 d-flex gap-2 no-print">
        <button class="btn btn-secondary" onclick="window.print()">Imprimir</button>
        <a href="#" class="btn btn-danger disabled">Exportar PDF</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Equipo</th>
                <th>Técnico</th>
                <th>Status</th>
                <th>Descripción</th>
                <th>Recepción</th>
                <th>Salida</th>
            </tr>
        </thead>
        <tbody>
            @forelse($repairOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->device->client->name ?? '-' }}</td>
                <td>{{ $order->device->model ?? '-' }}</td>
                <td>{{ $order->technician->name ?? '-' }}</td>
                <td>{{ $order->status->name ?? '-' }}</td>
                <td>{{ $order->description }}</td>
                <td>{{ $order->entry_date }}</td>
                <td>{{ $order->exit_date }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay resultados para los filtros seleccionados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 
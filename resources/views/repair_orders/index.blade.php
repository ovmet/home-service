@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Órdenes de Reparación</h1>
    <a href="{{ route('repair-orders.create') }}" class="btn btn-primary mb-3">Nueva Orden</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="GET" action="" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" id="status_id" class="form-select">
                <option value="">Todos</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="technician_id" class="form-label">Técnico</label>
            <select name="technician_id" id="technician_id" class="form-select">
                <option value="">Todos</option>
                @foreach($technicians as $technician)
                    <option value="{{ $technician->id }}" {{ request('technician_id') == $technician->id ? 'selected' : '' }}>{{ $technician->name }}</option>
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
        <div class="col-md-3 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            <a href="{{ route('repair-orders.export.pdf', request()->query()) }}" class="btn btn-danger w-100" target="_blank">Exportar PDF</a>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Equipo</th>
                <th>Técnico</th>
                <th>Status</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repairOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->device->client->name ?? '-' }}</td>
                <td>{{ $order->device->model ?? '-' }}</td>
                <td>{{ $order->technician->name ?? '-' }}</td>
                <td>{{ $order->status->name ?? '-' }}</td>
                <td>{{ $order->description }}</td>
                <td>{{ $order->cost }}</td>
                <td>{{ $order->entry_date }}</td>
                <td>{{ $order->exit_date }}</td>
                <td>{{ $order->service_location == 'foraneo' ? 'Foráneo' : 'En taller' }}</td>
                <td>
                    <a href="{{ route('repair-orders.show', $order) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('repair-orders.edit', $order) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('repair-orders.destroy', $order) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta orden?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
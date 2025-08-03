@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Resultados de Búsqueda</h1>
        <a href="/" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Inicio
        </a>
    </div>

    @if($repairOrders->count() > 0)
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Se encontraron {{ $repairOrders->count() }} orden(es) que coinciden con los criterios de búsqueda.
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-list"></i> Órdenes Encontradas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Equipo</th>
                                <th>Técnico</th>
                                <th>Status</th>
                                <th>Descripción</th>
                                <th>Fecha Entrada</th>
                                <th>Ubicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($repairOrders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->device->client->name ?? '-' }}</td>
                                <td>{{ $order->device->model ?? '-' }}</td>
                                <td>{{ $order->technician->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status->name == 'Completado' ? 'success' : ($order->status->name == 'En Proceso' ? 'warning' : 'secondary') }}">
                                        {{ $order->status->name ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if($order->description)
                                        <span title="{{ $order->description }}">
                                            {{ Str::limit($order->description, 30) }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $order->entry_date ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->service_location == 'foraneo' ? 'info' : 'primary' }}">
                                        {{ $order->service_location == 'foraneo' ? 'Foráneo' : 'Taller' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('repair-orders.show', $order) }}" class="btn btn-sm btn-info" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('repair-orders.edit', $order) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>No se encontraron órdenes</strong> que coincidan con los criterios de búsqueda.
            <br>
            <a href="/" class="btn btn-primary mt-2">Realizar Nueva Búsqueda</a>
        </div>
    @endif
</div>
@endsection 
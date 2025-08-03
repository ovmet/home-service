@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $company = \App\Models\Company::first();
    @endphp
    @if($company)
        <div class="text-center mb-4">
            @if($company->logo)
                <img src="/{{ $company->logo }}" alt="Logotipo" style="max-width:200px; max-height:200px;">
            @endif
            <h2>{{ $company->name }}</h2>
            <p>{{ $company->address }}</p>
            <p style="font-size: 14px; color: #555;">
                {{ $company->phone }}
                @if($company->phone && $company->email) | @endif
                {{ $company->email }}
            </p>
        </div>
    @endif
    <div class="text-center mb-4">
        <a href="{{ route('repair-orders.create') }}" class="btn btn-success btn-lg" style="margin-bottom: 20px;">
            <i class="fas fa-plus"></i> NUEVA ORDEN
        </a>
        <a href="{{ route('repair-orders.reporte.foraneo-taller') }}" class="btn btn-info btn-lg" style="margin-bottom: 20px; margin-left: 10px;">
            <i class="fas fa-calendar-alt"></i> ORDENES x FECHAS
        </a>
    </div>
    
    <!-- Formulario de Búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5><i class="fas fa-search"></i> Búsqueda Avanzada de Órdenes</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('repair-orders.search') }}" class="row g-3">
                <div class="col-md-2">
                    <label for="order_id" class="form-label">ID Orden</label>
                    <input type="number" name="order_id" id="order_id" class="form-control" value="{{ request('order_id') }}" placeholder="Ej: 123">
                </div>
                <div class="col-md-2">
                    <label for="client_name" class="form-label">Cliente</label>
                    <input type="text" name="client_name" id="client_name" class="form-control" value="{{ request('client_name') }}" placeholder="Nombre del cliente">
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label">Desde Fecha</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">Hasta Fecha</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-2">
                    <label for="technician_name" class="form-label">Técnico</label>
                    <input type="text" name="technician_name" id="technician_name" class="form-control" value="{{ request('technician_name') }}" placeholder="Nombre del técnico">
                </div>
                <div class="col-md-2">
                    <label for="status_id" class="form-label">Status</label>
                    <select name="status_id" id="status_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach(\App\Models\Status::all() as $status)
                            <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                    <a href="/" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>
    <h1 class="mb-4">Bienvenido al CRM de Reparaciones</h1>
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title">Órdenes de Reparación</h5>
                    <a href="{{ route('repair-orders.index') }}" class="btn btn-primary mt-2">Ver Órdenes</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100 border-danger">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title text-danger">Reporte de rutas</h5>
                    <a href="{{ route('repair-orders.reporte.foraneo-taller') }}" class="btn btn-danger mt-2">Ver reporte foráneo/taller</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
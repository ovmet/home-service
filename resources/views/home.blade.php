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
        <a href="{{ route('repair-orders.reporte.fechas') }}" class="btn btn-info btn-lg" style="margin-bottom: 20px; margin-left: 10px;">
            <i class="fas fa-calendar-alt"></i> ORDENES x FECHAS
        </a>
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
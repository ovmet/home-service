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
            <p>{{ $company->phone }}</p>
            <p>{{ $company->email }}</p>
        </div>
    @endif
    <h1 class="mb-4">Bienvenido al CRM de Reparaciones</h1>
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title">Técnicos</h5>
                    <a href="{{ route('technicians.index') }}" class="btn btn-primary mt-2">Ver Técnicos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title">Clientes</h5>
                    <a href="{{ route('clients.index') }}" class="btn btn-primary mt-2">Ver Clientes</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title">Equipos</h5>
                    <a href="{{ route('devices.index') }}" class="btn btn-primary mt-2">Ver Equipos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title">Órdenes de Reparación</h5>
                    <a href="{{ route('repair-orders.index') }}" class="btn btn-primary mt-2">Ver Órdenes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
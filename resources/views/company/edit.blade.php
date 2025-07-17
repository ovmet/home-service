@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Datos de la Empresa</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $company->address ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logotipo (200x200px recomendado)</label>
            <input type="file" name="logo" class="form-control">
            @if(!empty($company->logo))
                <div class="mt-2">
                    <img src="/{{ $company->logo }}" alt="Logotipo" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection 
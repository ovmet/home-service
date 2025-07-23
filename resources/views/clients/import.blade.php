@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Importar Clientes</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5>Instrucciones</h5>
        </div>
        <div class="card-body">
            <p>Para importar clientes, prepare un archivo Excel (.xlsx o .xls) con las siguientes columnas:</p>
            <ul>
                <li><strong>nombre</strong> (obligatorio): Nombre del cliente</li>
                <li><strong>telefono</strong> (opcional): Número de teléfono</li>
                <li><strong>email</strong> (opcional): Dirección de email</li>
                <li><strong>direccion</strong> (opcional): Dirección del cliente</li>
                <li><strong>notas</strong> (opcional): Notas adicionales</li>
            </ul>
            <p><strong>Nota:</strong> La primera fila debe contener los nombres de las columnas.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Subir Archivo</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Archivo Excel</label>
                    <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls" required>
                    <div class="form-text">Seleccione un archivo Excel (.xlsx o .xls)</div>
                </div>
                <button type="submit" class="btn btn-primary">Importar Clientes</button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h5>Ejemplo de formato:</h5>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>nombre</th>
                    <th>telefono</th>
                    <th>email</th>
                    <th>direccion</th>
                    <th>notas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Juan Pérez</td>
                    <td>555-1234</td>
                    <td>juan@email.com</td>
                    <td>Calle Principal 123</td>
                    <td>Cliente frecuente</td>
                </tr>
                <tr>
                    <td>María García</td>
                    <td>555-5678</td>
                    <td>maria@email.com</td>
                    <td>Av. Central 456</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 
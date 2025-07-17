@php
    $company = \App\Models\Company::first();
@endphp
@if($company)
    <div style="text-align:center; margin-bottom: 20px;">
        @if($company->logo)
            <img src="{{ public_path($company->logo) }}" alt="Logotipo" style="max-width:100px; max-height:100px;">
        @endif
        <h2 style="margin:0;">{{ $company->name }}</h2>
        <div style="font-size:12px;">{{ $company->address }} | {{ $company->phone }} | {{ $company->email }}</div>
    </div>
@endif
<h2>Órdenes de Reparación</h2>
<table border="1" width="100%" cellspacing="0" cellpadding="4">
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
        </tr>
        @endforeach
    </tbody>
</table> 
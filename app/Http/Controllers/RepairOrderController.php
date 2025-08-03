<?php

namespace App\Http\Controllers;

use App\Models\RepairOrder;
use App\Models\Device;
use App\Models\Technician;
use App\Models\Status;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RepairOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = RepairOrder::with(['device.client', 'technician', 'status']);

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }
        if ($request->filled('technician_id')) {
            $query->where('technician_id', $request->technician_id);
        }
        if ($request->filled('client_id')) {
            $query->whereHas('device.client', function ($q) use ($request) {
                $q->where('id', $request->client_id);
            });
        }

        $repairOrders = $query->get();
        $statuses = \App\Models\Status::all();
        $technicians = \App\Models\Technician::all();
        $clients = \App\Models\Client::all();
        return view('repair_orders.index', compact('repairOrders', 'statuses', 'technicians', 'clients'));
    }

    public function create(Request $request)
    {
        $clientId = $request->get('client_id');
        $clients = \App\Models\Client::all();
        $devices = $clientId ? \App\Models\Device::where('client_id', $clientId)->get() : collect();
        $technicians = \App\Models\Technician::all();
        $statuses = \App\Models\Status::all();
        return view('repair_orders.create', compact('clients', 'devices', 'technicians', 'statuses', 'clientId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'technician_id' => 'nullable|exists:technicians,id',
            'status_id' => 'required|exists:statuses,id',
            'description' => 'nullable|string',
            'cost' => 'nullable|numeric',
            'entry_date' => 'nullable|date',
            'exit_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        $repairOrder = RepairOrder::create($validated);
        return redirect()->route('repair-orders.show', $repairOrder->id)
            ->with('success', 'Orden de reparación creada correctamente. El ID de la orden es: ' . $repairOrder->id);
    }

    public function show(RepairOrder $repairOrder)
    {
        return view('repair_orders.show', compact('repairOrder'));
    }

    public function edit(RepairOrder $repairOrder)
    {
        $devices = Device::all();
        $technicians = Technician::all();
        $statuses = Status::all();
        return view('repair_orders.edit', compact('repairOrder', 'devices', 'technicians', 'statuses'));
    }

    public function update(Request $request, RepairOrder $repairOrder)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'technician_id' => 'nullable|exists:technicians,id',
            'status_id' => 'required|exists:statuses,id',
            'description' => 'nullable|string',
            'cost' => 'nullable|numeric',
            'entry_date' => 'nullable|date',
            'exit_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        $repairOrder->update($validated);
        return redirect()->route('repair-orders.index')->with('success', 'Orden de reparación actualizada correctamente.');
    }

    public function destroy(RepairOrder $repairOrder)
    {
        $repairOrder->delete();
        return redirect()->route('repair-orders.index')->with('success', 'Orden de reparación eliminada correctamente.');
    }

    public function exportPdf(Request $request)
    {
        $query = RepairOrder::with(['device.client', 'technician', 'status']);
        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }
        if ($request->filled('technician_id')) {
            $query->where('technician_id', $request->technician_id);
        }
        if ($request->filled('client_id')) {
            $query->whereHas('device.client', function ($q) use ($request) {
                $q->where('id', $request->client_id);
            });
        }
        $repairOrders = $query->get();
        $pdf = Pdf::loadView('repair_orders.pdf', compact('repairOrders'));
        return $pdf->download('ordenes_reparacion.pdf');
    }

    public function reporteForaneoTaller(Request $request)
    {
        $query = RepairOrder::with(['device.client', 'device.deviceType']);
        if ($request->filled('service_location')) {
            $query->where('service_location', $request->service_location);
        }
        if ($request->filled('entry_date_from')) {
            $query->whereDate('entry_date', '>=', $request->entry_date_from);
        }
        if ($request->filled('entry_date_to')) {
            $query->whereDate('entry_date', '<=', $request->entry_date_to);
        }
        $repairOrders = $query->get();
        return view('repair_orders.reporte', compact('repairOrders'));
    }

    public function reporteForaneoTallerPdf(Request $request)
    {
        $query = RepairOrder::with(['device.client', 'device.deviceType']);
        if ($request->filled('service_location')) {
            $query->where('service_location', $request->service_location);
        }
        if ($request->filled('entry_date_from')) {
            $query->whereDate('entry_date', '>=', $request->entry_date_from);
        }
        if ($request->filled('entry_date_to')) {
            $query->whereDate('entry_date', '<=', $request->entry_date_to);
        }
        $repairOrders = $query->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('repair_orders.reporte_pdf', compact('repairOrders'));
        return $pdf->download('reporte_servicios.pdf');
    }

    public function reporteFechas(Request $request)
    {
        $query = RepairOrder::with(['device.client', 'technician', 'status']);
        if ($request->filled('entry_date_from')) {
            $query->whereDate('entry_date', '>=', $request->entry_date_from);
        }
        if ($request->filled('entry_date_to')) {
            $query->whereDate('entry_date', '<=', $request->entry_date_to);
        }
        if ($request->filled('technician_id')) {
            $query->where('technician_id', $request->technician_id);
        }
        if ($request->filled('client_id')) {
            $query->whereHas('device.client', function ($q) use ($request) {
                $q->where('id', $request->client_id);
            });
        }
        $repairOrders = $query->get();
        $technicians = \App\Models\Technician::all();
        $clients = \App\Models\Client::all();
        return view('repair_orders.reporte_fechas', compact('repairOrders', 'technicians', 'clients'));
    }

    public function search(Request $request)
    {
        $query = RepairOrder::with(['device.client', 'technician', 'status']);

        // Búsqueda por ID de orden
        if ($request->filled('order_id')) {
            $query->where('id', $request->order_id);
        }

        // Búsqueda por nombre de cliente
        if ($request->filled('client_name')) {
            $query->whereHas('device.client', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->client_name . '%');
            });
        }

        // Búsqueda por rango de fechas
        if ($request->filled('date_from')) {
            $query->whereDate('entry_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('entry_date', '<=', $request->date_to);
        }

        // Búsqueda por nombre de técnico
        if ($request->filled('technician_name')) {
            $query->whereHas('technician', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->technician_name . '%');
            });
        }

        // Búsqueda por status
        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        $repairOrders = $query->orderBy('id', 'desc')->get();
        
        return view('repair_orders.search_results', compact('repairOrders'));
    }
}

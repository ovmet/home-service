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
}

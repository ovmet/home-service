<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Client;
use App\Models\Brand;
use App\Models\DeviceType;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with(['client', 'brand', 'deviceType'])->get();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $clients = Client::all();
        $brands = Brand::all();
        $deviceTypes = DeviceType::all();
        return view('devices.create', compact('clients', 'brands', 'deviceTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'brand_id' => 'required|exists:brands,id',
            'device_type_id' => 'required|exists:device_types,id',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
        ]);
        Device::create($validated);
        return redirect()->route('devices.index')->with('success', 'Equipo creado correctamente.');
    }

    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        $clients = Client::all();
        $brands = Brand::all();
        $deviceTypes = DeviceType::all();
        return view('devices.edit', compact('device', 'clients', 'brands', 'deviceTypes'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'brand_id' => 'required|exists:brands,id',
            'device_type_id' => 'required|exists:device_types,id',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
        ]);
        $device->update($validated);
        return redirect()->route('devices.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Equipo eliminado correctamente.');
    }
}

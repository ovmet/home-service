<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviceTypes = \App\Models\DeviceType::all();
        return view('device_types.index', compact('deviceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('device_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $device_type = new \App\Models\DeviceType();
        $device_type->name = $request->name;
        $device_type->save();
        return redirect()->route('device-types.index')->with('success', 'Tipo de equipo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $device_type = \App\Models\DeviceType::findOrFail($id);
        return view('device_types.show', compact('device_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $device_type = \App\Models\DeviceType::findOrFail($id);
        return view('device_types.edit', compact('device_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $device_type = \App\Models\DeviceType::findOrFail($id);
        $device_type->name = $request->name;
        $device_type->save();
        return redirect()->route('device-types.index')->with('success', 'Tipo de equipo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $device_type = \App\Models\DeviceType::findOrFail($id);
        $device_type->delete();
        return redirect()->route('device-types.index')->with('success', 'Tipo de equipo eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = \App\Models\Status::all();
        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $status = new \App\Models\Status();
        $status->name = $request->name;
        $status->save();
        return redirect()->route('statuses.index')->with('success', 'Status creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = \App\Models\Status::findOrFail($id);
        return view('statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $status = \App\Models\Status::findOrFail($id);
        $status->name = $request->name;
        $status->save();
        return redirect()->route('statuses.index')->with('success', 'Status actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = \App\Models\Status::findOrFail($id);
        $status->delete();
        return redirect()->route('statuses.index')->with('success', 'Status eliminado exitosamente.');
    }
}

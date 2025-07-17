<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function edit()
    {
        $company = Company::first();
        return view('company.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $company = Company::first();
        if (!$company) {
            $company = new Company();
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads'), $logoName);
            $data['logo'] = 'uploads/' . $logoName;
        }
        $company->fill($data);
        $company->save();
        return redirect()->route('company.edit')->with('success', 'Datos de la empresa actualizados correctamente.');
    }
}

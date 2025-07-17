<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairOrderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('home');
});

Route::resource('technicians', TechnicianController::class);
Route::resource('clients', ClientController::class);
Route::resource('devices', DeviceController::class);
Route::resource('repair-orders', RepairOrderController::class);
Route::resource('brands', BrandController::class);
Route::resource('device-types', DeviceTypeController::class);
Route::resource('statuses', StatusController::class);
Route::get('repair-orders/export/pdf', [App\Http\Controllers\RepairOrderController::class, 'exportPdf'])->name('repair-orders.export.pdf');
Route::get('/company', [App\Http\Controllers\CompanyController::class, 'edit'])->name('company.edit');
Route::post('/company', [App\Http\Controllers\CompanyController::class, 'update'])->name('company.update');

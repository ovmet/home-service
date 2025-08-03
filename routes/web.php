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
Route::get('clients/import', [App\Http\Controllers\ClientController::class, 'importForm'])->name('clients.import.form');
Route::post('clients/import', [App\Http\Controllers\ClientController::class, 'import'])->name('clients.import');
Route::resource('clients', ClientController::class);
Route::resource('devices', DeviceController::class);
Route::get('repair-orders/search', [App\Http\Controllers\RepairOrderController::class, 'search'])->name('repair-orders.search');
Route::resource('repair-orders', RepairOrderController::class);
Route::resource('brands', BrandController::class);
Route::resource('device-types', DeviceTypeController::class);
Route::resource('statuses', StatusController::class);
Route::get('repair-orders/export/pdf', [App\Http\Controllers\RepairOrderController::class, 'exportPdf'])->name('repair-orders.export.pdf');
Route::get('repair-orders/reporte/foraneo-taller', [App\Http\Controllers\RepairOrderController::class, 'reporteForaneoTaller'])->name('repair-orders.reporte.foraneo-taller');
Route::get('repair-orders/reporte/foraneo-taller/pdf', [App\Http\Controllers\RepairOrderController::class, 'reporteForaneoTallerPdf'])->name('repair-orders.reporte.foraneo-taller.pdf');
Route::get('repair-orders/reporte/fechas', [App\Http\Controllers\RepairOrderController::class, 'reporteFechas'])->name('repair-orders.reporte.fechas');
Route::get('/company', [App\Http\Controllers\CompanyController::class, 'edit'])->name('company.edit');
Route::post('/company', [App\Http\Controllers\CompanyController::class, 'update'])->name('company.update');

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['client_id', 'brand_id', 'device_type_id', 'model', 'serial_number'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class);
    }
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class);
    }
}

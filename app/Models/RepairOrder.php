<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    protected $fillable = ['device_id', 'technician_id', 'status_id', 'description', 'cost', 'entry_date', 'exit_date', 'notes', 'service_location'];
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

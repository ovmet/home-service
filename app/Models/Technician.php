<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'notes'];

    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class);
    }
}

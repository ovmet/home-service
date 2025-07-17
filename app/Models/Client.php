<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'notes'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}

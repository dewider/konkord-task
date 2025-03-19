<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorValue extends Model
{
    protected $fillable = [
        'sensor_id',
        'key',
        'value',
    ];
    //
}

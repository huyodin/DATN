<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirLineTicket extends Model
{
    use HasFactory;

    protected $table = 'airline_ticket';

    protected $fillable = [
        'area_id_start',
        'area_id_end',
        'start_date',
        'end_date',
        'quantity',
        'logo',
        'price',
        'name',
    ];

    public function areaStart()
    {
        return $this->belongsTo(Area::class, 'area_id_start');
    }

    public function areaEnd()
    {
        return $this->belongsTo(Area::class, 'area_id_end');
    }
}

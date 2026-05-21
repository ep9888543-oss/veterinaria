<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntecedentePatologico extends Model
{
    protected $fillable = [
        'mascota_id',
        'enfermedad',
        'es_cronica',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}

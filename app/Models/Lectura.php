<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    use HasFactory;
    protected $table = 'lectura';
    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    protected $table = 'lectura';

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}
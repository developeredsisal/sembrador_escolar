<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    protected $table = 'niveles';
    public function mundo()
    {
        return $this->belongsTo(Mundo::class);
    }

    public function lecturas()
    {
        return $this->hasMany(Lectura::class);
    }
}

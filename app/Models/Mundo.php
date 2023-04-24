<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mundo extends Model
{
    use HasFactory;
    protected $table = 'mundos';
    public function niveles()
    {
        return $this->hasMany(Nivel::class);
    }
}

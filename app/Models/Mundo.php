<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mundo extends Model
{
    use HasFactory;
    protected $table = 'mundo';
    public function niveles()
    {
        return $this->hasMany(Nivel::class);
    }

    public function grado()
    {
        return $this->BelongsTo(Grado::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradoSeeder extends Seeder
{
    public function run()
    {
        DB::table('grado')->insert([
            [
                'id' => 1,
                'nombre' => 'Primero',
            ],
            [
                'id' => 2,
                'nombre' => 'Segundo',
            ],
            [
                'id' => 3,
                'nombre' => 'Tercero',
            ],
            [
                'id' => 4,
                'nombre' => 'Cuarto'
            ],
            [
                'id' => 5,
                'nombre' => 'Quinto'
            ],
            [
                'id' => 6,
                'nombre' => 'Sexto'
            ]
        ]);
    }
}
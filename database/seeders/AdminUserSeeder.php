<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        
        $admin = User::create([
            'name' => 'Editorial Edisal',
            'email' => 'sembradorescolar@editorialedisal.com',
            'password' => Hash::make('gee/182#SU'),
        ]);
        
        $admin->assignRole($adminRole);

    }
}


<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'user@generic.com',
            'password' => Hash::make('user@generic.com'),
            'is_manager' => true,
            'is_teacher' => false,
            'is_student' => false,
            'is_active' => true,
        ]);
    }
}

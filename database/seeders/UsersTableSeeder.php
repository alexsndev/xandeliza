<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar usuário Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@exemplo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Criar usuário Gerente
        User::create([
            'name' => 'Gerente',
            'email' => 'gerente@exemplo.com',
            'password' => Hash::make('password'),
            'role' => 'gerente',
        ]);

        // Criar usuário Cliente
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@exemplo.com',
            'password' => Hash::make('password'),
            'role' => 'cliente',
        ]);
    }
}

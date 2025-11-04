<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'login' => 'admin',
            'nome' => 'admin',
            'email' => 'admin@mudar123.com',
            'senha' => 'Alterar123@',
            'setor_id' => 1,
            'is_administrator' => true
        ]);
    }
}

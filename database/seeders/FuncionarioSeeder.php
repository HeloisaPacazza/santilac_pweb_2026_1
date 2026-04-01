<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Funcionario::create([
            'nome' => 'João',
            'email' => 'joao@email.com',
            'telefone' => '99999-9999',
            'carga_horaria' => 40
        ]);
    }
}

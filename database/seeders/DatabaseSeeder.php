<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Criar Administrador
        \App\Models\User::factory()->create([
            'name' => 'Admin Chefe',
            'email' => 'admin@agencia.com',
            'password' => bcrypt('senha123'),
            'role' => 'admin',
        ]);

        // Criar Desenvolvedor
        $dev = \App\Models\User::factory()->create([
            'name' => 'Desenvolvedor Junior',
            'email' => 'dev@agencia.com',
            'password' => bcrypt('senha123'),
            'role' => 'dev',
        ]);

        // Criar 5 projetos, cada um com 3 tarefas associadas ao Dev
        \App\Models\Project::factory(5)->create()->each(function ($project) use ($dev) {
            \App\Models\Task::factory(3)->create([
                'project_id' => $project->id,
                'user_id' => $dev->id,
            ]);
        });
    }
}

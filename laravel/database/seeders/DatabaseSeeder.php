<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$ytyb9rAV0UWUGVtyOT3otOb9uKKjd8njzllTSTUcb410IiYSU5kMC',
            'FirstAccess' => '0',
            'admin' => '1',
            'docente' => '1',
            'discente' => '1',
        ]);

        DB::table('questions')->insert([
            'tag' => 'Teste Aberta',
            'enunciado' => 'Qual a melhor linguagem de programação?',
            'Answer' => 'PHP',
            'tipoQuestao' => '1',
        ]);
    }
}

<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // se não utilizar email_verified_at ou remember_token abre o UserFactory.php
        // e tira ou comenta.
        User::create([
            'name' => 'Fulano de Tal',
            'email' => 'fulano@gmail.com',
            'password' => bcrypt('123456'), // Força o hash para evitar erros de cast
            'is_admin' => true,
            'data_nasc' => '1995-05-20',
            'bio' => 'Desenvolvedor Laravel.',
            'xp' => 10,
        ]);
    }
}

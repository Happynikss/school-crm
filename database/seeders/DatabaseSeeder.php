<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Створюємо тестового Адміністратора
        \App\Models\User::factory()->create([
            'name' => 'Микита Демешко (Адмін)',
            'email' => 'admin@school.com',
            'password' => bcrypt('password'), // пароль для входу: password
            'role' => 'admin',
        ]);

        // Створюємо тестового Викладача
        \App\Models\User::factory()->create([
            'name' => 'Ігор Петрович (Викладач)',
            'email' => 'teacher@school.com',
            'password' => bcrypt('password'), // пароль для входу: password
            'role' => 'teacher',
        ]);
    }
}

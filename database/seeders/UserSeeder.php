<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Création de l'admin
        User::factory()->admin()->create([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'System',
            'password' => bcrypt('admin123')
        ]);

        // Création du lecteur
        User::factory()->reader()->create([
            'username' => 'reader',
            'firstname' => 'Basic',
            'lastname' => 'Reader',
            'password' => bcrypt('reader123')
        ]);

        // Création du lecteur étendu
        User::factory()->extendedReader()->create([
            'username' => 'extended',
            'firstname' => 'Extended',
            'lastname' => 'Reader',
            'password' => bcrypt('extended123')
        ]);
    }
} 
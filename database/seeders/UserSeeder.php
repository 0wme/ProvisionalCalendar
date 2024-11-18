<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Création de l'admin avec son profil enseignant
        $admin = User::factory()->admin()->create([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'System',
            'password' => bcrypt('admin123')
        ]);

        // Création du lecteur avec son profil enseignant
        $reader = User::factory()->reader()->create([
            'username' => 'reader',
            'firstname' => 'Basic',
            'lastname' => 'Reader',
            'password' => bcrypt('reader123')
        ]);
        

        // Création du lecteur étendu avec son profil enseignant
        $extended = User::factory()->extendedReader()->create([
            'username' => 'extended',
            'firstname' => 'Extended',
            'lastname' => 'Reader',
            'password' => bcrypt('extended123')
        ]);
    }
} 
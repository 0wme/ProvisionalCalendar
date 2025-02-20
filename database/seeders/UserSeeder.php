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
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123')
        ]);

        // Création du lecteur avec son profil enseignant
        $reader = User::factory()->reader()->create([
            'username' => 'reader',
            'firstname' => 'Basic',
            'lastname' => 'Reader',
            'email' => 'reader@example.com',
            'password' => bcrypt('reader123')
        ]);


        // Création du lecteur étendu avec son profil enseignant
        $extended = User::factory()->extendedReader()->create([
            'username' => 'extended',
            'firstname' => 'Extended',
            'lastname' => 'Reader',
            'email' => 'extended@example.com',
            'password' => bcrypt('extended123')
        ]);

        User::factory()->admin()->create([
            'username' => 'ldubreuil',
            'firstname' => 'Laurent',
            'lastname' => 'DUBREUIL',
            'email' => 'ldubreuil@example.com',
            'password' => bcrypt('ldubreuil123')
        ]);

        User::factory()->admin()->create([
            'username' => 'apoursat',
            'firstname' => 'Anais',
            'lastname' => 'POURSAT',
            'email' => 'apoursat@example.com',
            'password' => bcrypt('apoursat123')
        ]);

        User::factory()->admin()->create([
            'username' => 'conete',
            'firstname' => 'Cristina',
            'lastname' => 'ONETE',
            'email' => 'conete@example.com',
            'password' => bcrypt('conete123')
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['level' => 0, 'name' => 'administrator'],
            ['level' => 1, 'name' => 'extended_reader'],
            ['level' => 2, 'name' => 'reader'],
        ]);
    }
} 
<?php

namespace Database\Seeders\Groups;

use Illuminate\Database\Seeder;
use App\Models\Groups\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'name' => 'G1',
            'promotion_id' => 1
        ]);
        Group::create([
            'name' => 'G2',
            'promotion_id' => 1
        ]);
        Group::create([
            'name' => 'G3',
            'promotion_id' => 1
        ]);
        Group::create([
            'name' => 'G4',
            'promotion_id' => 2
        ]);
        Group::create([
            'name' => 'G5',
            'promotion_id' => 2
        ]);
        Group::create([
            'name' => 'G6',
            'promotion_id' => 3
        ]);
        Group::create([
            'name' => 'G7',
            'promotion_id' => 3
        ]);
    }
}

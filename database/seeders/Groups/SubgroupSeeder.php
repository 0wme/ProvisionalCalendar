<?php

namespace Database\Seeders\Groups;

use Illuminate\Database\Seeder;
use App\Models\Groups\Subgroup;

class SubgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subgroup::create([
            'name' => 'G1A',
            'group_id' => 1
        ]);
        Subgroup::create([
            'name' => 'G1B',
            'group_id' => 1
        ]);
        Subgroup::create([
            'name' => 'G2A',
            'group_id' => 2
        ]);
        Subgroup::create([
            'name' => 'G2B',
            'group_id' => 2
        ]);
        Subgroup::create([
            'name' => 'G3A',
            'group_id' => 3
        ]);
        Subgroup::create([
            'name' => 'G3B',
            'group_id' => 3
        ]);
        Subgroup::create([
            'name' => 'G4A',
            'group_id' => 4
        ]);
        Subgroup::create([
            'name' => 'G4B',
            'group_id' => 4
        ]);
        Subgroup::create([
            'name' => 'G5A',
            'group_id' => 5
        ]);
        Subgroup::create([
            'name' => 'G5B',
            'group_id' => 5
        ]);
        Subgroup::create([
            'name' => 'G6A',
            'group_id' => 6
        ]);
        Subgroup::create([
            'name' => 'G6B',
            'group_id' => 6
        ]);
        Subgroup::create([
            'name' => 'G7A',
            'group_id' => 7
        ]);
        Subgroup::create([
            'name' => 'G7B',
            'group_id' => 7
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = [
            ['name' =>  'Critical', 'color'  =>  '#FF0000'],
            ['name' =>  'High',     'color'  =>  '#FFFF00'],
            ['name' =>  'Medium',   'color'  =>  '#0000FF'],
            ['name' =>  'Low',      'color'  =>  '#008000'],
        ];

        foreach($priorities as $priority)
        {
            \App\Models\Priority::factory()->create([
                'name'      => $priority['name'],
                'color'     => $priority['color'],
            ]);
        }
    }
}

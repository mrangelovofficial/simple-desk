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
            ['name' =>  'Critical', 'color'  =>  'text-red-700'],
            ['name' =>  'High',     'color'  =>  'text-yellow-300'],
            ['name' =>  'Medium',   'color'  =>  'text-blue-500'],
            ['name' =>  'Low',      'color'  =>  'text-green-400'],
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

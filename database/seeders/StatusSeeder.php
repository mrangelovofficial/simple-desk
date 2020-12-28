<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = [
            ['name' =>  'New',      'color' =>  '#FFA500'],
            ['name' =>  'Open',     'color' =>  '#000080'],
            ['name' =>  'On Hold',  'color' =>  '#35530a'],
            ['name' =>  'Solved',   'color' =>  '#90EE90'],
            ['name' =>  'Closed',   'color' =>  '#808080'],
        ];

        foreach($priorities as $priority)
        {
            \App\Models\Status::factory()->create([
                'name'      => $priority['name'],
                'color'     => $priority['color'],
            ]);
        }
    }
}

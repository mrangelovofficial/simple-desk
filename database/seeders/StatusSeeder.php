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
            ['name' =>  'New',      'bg_color' =>  'bg-orange-500',     'text_color' =>  'text-orange-100'],
            ['name' =>  'Open',     'bg_color' =>  'bg-blue-500',       'text_color' =>  'text-blue-100'],
            ['name' =>  'On Hold',  'bg_color' =>  'bg-red-600',        'text_color' =>  'text-red-100'],
            ['name' =>  'Client',   'bg_color' =>  'bg-green-400',      'text_color' =>  'text-green-100'],
            ['name' =>  'Closed',   'bg_color' =>  'bg-gray-200',       'text_color' =>  'text-gray-600'],
        ];

        foreach($priorities as $priority)
        {
            \App\Models\Status::factory()->create([
                'name'      => $priority['name'],
                'bg_color'     => $priority['bg_color'],
                'text_color'     => $priority['text_color'],
            ]);
        }
    }
}

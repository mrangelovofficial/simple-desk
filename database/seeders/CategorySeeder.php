<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Bugs',  'Feature requests', 'Technical questions',  'Billing issues',   'How to\'s'];
        foreach($categories as $category){
            \App\Models\Category::factory()
                    ->create([
                        'name'=>$category
                    ]);

        }

    }
}

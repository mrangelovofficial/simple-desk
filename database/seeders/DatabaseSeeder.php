<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PrioritySeeder::class, //Can be used in prod
            StatusSeeder::class, //Can be used in prod
        ]);

        // Only for local environment
        if (\Illuminate\Support\Facades\App::environment('local')) {
            $this->call([
                UserSeeder::class, //Fake users
                CategorySeeder::class, //Fake category
                TicketSeeder::class, //Fake category
                CommentSeeder::class //Fake comments
            ]);

        }
    }
}

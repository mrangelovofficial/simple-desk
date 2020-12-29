<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();
        \App\Models\User::factory()->create([
            'email'     => 'admin@example.com',
            'is_admin'     => '1',
        ]);
        \App\Models\User::factory()->create([
            'email'     => 'client@example.com',
            'is_admin'     => '0',
        ]);
        \App\Models\User::factory()->create([
            'email'     => 'superadmin@example.com',
            'is_superadmin'     => '1',
            'is_admin'     => '1',
        ]);
    }
}

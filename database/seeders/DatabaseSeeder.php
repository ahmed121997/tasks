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
        \App\Models\Task::factory(1)->create([
            'status' => 0,
            'user_id' => 2,
            'name' => "test 22",
            'dec' => "odifo og gu i ii ii hi",
            'dead_line' => now(),

        ]);
    }
}

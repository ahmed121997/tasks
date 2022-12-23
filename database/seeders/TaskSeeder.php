<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Str;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'name' => Str::random(20),
            'dec' => "odifo og gu i ii ii hi",
            'status' => 0,
            'user_id' => 2,
            'dead_line' => now()->addDay(5),

        ]);
    }
}

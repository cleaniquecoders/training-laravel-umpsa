<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::count()) {
            User::factory(rand(5, 10))->create();
        }

        User::query()
            ->get()
            ->each(
                fn ($user) => Task::factory(rand(5, 20))->create(['user_id' => $user->id])
            );
    }
}

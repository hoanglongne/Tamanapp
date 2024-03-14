<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Task;
use \App\Models\TaskAssignment;
use \App\Models\Comment;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            // For each user, create 5 tasks

    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);
    User::factory(10)->create();

    User::all()->each(function ($user) {
        Task::factory(5)->create(['created_by_user_id' => $user->id]);
    });

    // For each task, create 3 comments
    Task::all()->each(function ($task) {
        Comment::factory(3)->create(['task_id' => $task->id, 'user_id' => $task->created_by_user_id]);
    });
    
    TaskAssignment::factory()->count(20)->create();
    }

}

<?php
namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $faker = Faker::create();

        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'status' => $faker->randomElement([Task::STATUS_NOT_START, Task::STATUS_IN_PROCESS, Task::STATUS_PENDING, Task::STATUS_DONE]),
            'deadline' => $faker->dateTimeBetween('now', '+1 year'),
            'created_by_user_id' => User::factory(),
        ];
    }
}
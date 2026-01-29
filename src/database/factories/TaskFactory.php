<?php

namespace Database\Factories;

use App\Http\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(TaskStatus::cases())
        ];
    }

    // Наполним pivot таблицу данными
    public function configure()
    {
        return $this->afterCreating(function (Task $task) {

            if ($task->status === TaskStatus::New) {
                return;
            }

            $users = User::inRandomOrder()
                ->take(rand(1, 3))
                ->pluck('id');

            $task->users()->attach($users);

        });
    }
}

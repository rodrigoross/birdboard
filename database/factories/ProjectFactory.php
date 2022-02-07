<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'owner_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
        ];
    }
}

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
            'description' => $this->faker->sentence(15),
            'owner_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
        ];
    }

    /**
     * Indica qual usuario é o dono do projeto.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ownedBy(\App\Models\User $signedUser)
    {
        return $this->state(function (array $attributes) use ($signedUser) {
            return [
                'owner_id' => $signedUser->id,
            ];
        });
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->paragraph(1),
            'post_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}

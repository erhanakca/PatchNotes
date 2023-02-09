<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatchNote>
 */
class PatchNoteFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => rand(0,1),
            'text' => fake()->text,
            'date' => fake()->dateTimeBetween('-365 hour', '+600 day' )->format('Y-m-d')
        ];
    }
}

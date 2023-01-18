<?php

namespace Database\Factories;

use App\Models\PatchNote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PatchNote>
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
            'bug_id' => rand(1, 10),
            'innovation_id' => rand(1, 10),
            'tag_id' => rand(1, 10),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Lane;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trailer>
 */
class TrailerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => function () {
                $year = fake()->numberBetween(13, 25); // years 2013 to 2025
                $sequence = str_pad(fake()->numberBetween(1, 2000), 4, '0', STR_PAD_LEFT);
                return "{$year}{$sequence}";
            },
            'lane_id' => Lane::pluck('id')->random(),
            'created_by' => User::pluck('id')->random(),
        ];
    }
}

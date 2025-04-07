<?php

namespace Database\Factories;

use App\Models\Lane;
use App\Models\Trailer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Load>
 */
class LoadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => '0' . fake()->numberBetween(434000, 444000),
            'bol' => fake()->numberBetween(534000, 555000),
            'trailer_id' => Trailer::pluck('id')->random(),
            'lane_id' => Lane::pluck('id')->random(),
            'date' => \Carbon\Carbon::today()->subDays(rand(0, 6))->format('Y-m-d'),
            'created_by' => User::pluck('id')->random(),
            'created_at' => \Carbon\Carbon::now()->subDays(rand(0, 6))->subMinutes(rand(0, 1440)),
        ];
    }
}

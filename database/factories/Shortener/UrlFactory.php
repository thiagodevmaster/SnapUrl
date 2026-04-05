<?php

namespace Database\Factories\Shortener;

use App\Models\Identity\User;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'short_code' => $this->faker->unique()->regexify('[A-Za-z0-9]{6}'),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'url' => $this->faker->url(),
            'user_id' => User::factory(),
            'clicks' => 0,
            'last_accessed_at' => null,
            'expires_at' => null,
            'status' => true,
        ];
    }
}
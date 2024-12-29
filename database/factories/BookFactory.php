<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->text(), //fake()->sentence(),
            'ISBN' => fake()->isbn13(),
            // 'author_id' => 1,
            'author_id' => fake()->numberBetween(1, 10),
            // categories wordt opgevuld in de BookSeeder
        ];
    }
}

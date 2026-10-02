<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Palavra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Palavra>
 */
class PalavraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->word(),
            'categoria_id' => Categoria::inRandomOrder()->value('id'),
        ];
    }
}

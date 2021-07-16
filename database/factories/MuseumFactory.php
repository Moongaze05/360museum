<?php

namespace Database\Factories;

use App\Models\Museum;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class MuseumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Museum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'title' => "string",
        'preview' => "string",
        'logo' => "string"
    ])]
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(maxNbChars: 16),
            'preview' => $this->faker->imageUrl,
            'logo' => $this->faker->imageUrl
        ];
    }
}

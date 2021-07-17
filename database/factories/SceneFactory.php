<?php

namespace Database\Factories;

use App\Models\Scene;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class SceneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scene::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'title' => "string",
        'panorama' => "string"
    ])]
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText('16'),
            'panorama' => $this->faker->imageUrl
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Beer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeerFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Beer::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->sentence(rand(5,15)),
            'description' => $this->faker->text,
            'photo'       => $this->faker->image('public/images',640,480, null, false),
        ];
    }
}

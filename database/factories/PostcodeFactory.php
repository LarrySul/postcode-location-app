<?php

namespace Database\Factories;

use App\Models\Postcode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostcodeFactory extends Factory
{
    protected $model = Postcode::class;
    public function definition()
    {
        return [
            'pcd' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'pcd2' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'pcds' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'long' => $this->faker->randomFloat($maxDecimal = 3,$min = 20, $max = 30),
            'lat' => $this->faker->randomFloat($maxDecimal = 3, $min = -5, $max = -1),
            'usertype' => $this->faker->randomElement([0,1]),
        ];
    }
}

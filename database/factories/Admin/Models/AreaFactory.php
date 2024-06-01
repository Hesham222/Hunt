<?php

namespace Database\Factories\Admin\Models;

use Admin\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'en'        => ['name'  => 'en-'.$this->faker->word,],
            'ar'        => ['name'  => 'ar-'.$this->faker->word,],
            'city_id'   => $this->faker->numberBetween(1,27),
        ];
    }
}

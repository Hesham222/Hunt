<?php

namespace Database\Factories\Admin\Models;

use Admin\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'             => $this->faker->name,
            'last_name'              => $this->faker->name,
            'developer_name'         => $this->faker->word,
            'email'                  => $this->faker->unique()->email,
            'phone'                  => $this->faker->unique()->numerify('##########'),
            'password'               => '$2y$10$FzwIMFbhMNP/Wuw.SEaA6u9e7Gah/HMSCt0ec2Tx5H2vqzBJhYKKS', // password
            'date_of_birth'          => $this->faker->date('Y-m-d'),
            'image'                   => $this->faker->imageUrl($width = 200, $height = 200),
            'deviceType'             => 'Web',
            'status'                 => $this->faker->randomElement(['notVerified' ,'verified', 'blocked']),
        ];
    }
}

<?php

namespace Database\Factories\Admin\Models\Posts;
use Admin\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'individual_id'          => \Admin\Models\Individual::factory(),
            'post_reason_id'         => $this->faker->numberBetween(1,4),
            'post_reason_option_id'  => $this->faker->numberBetween(1,3),
            'city_id'                => $this->faker->numberBetween(1,27),
            'area_id'                => \Admin\Models\Area::factory(),
            'post_type_id'           => $this->faker->numberBetween(1,6),
            'in_a_compound'          => $this->faker->boolean,
            'start_price'            => $this->faker->numberBetween(1,999),
            'end_price'              => $this->faker->numberBetween(999, 20000),
            'post_sale_id'           => $this->faker->numberBetween(1,3),
            'post_completion_id'     => $this->faker->numberBetween(1,4),
            'post_status_id'         => $this->faker->numberBetween(1,3),
            'developer'              => $this->faker->name,
            'rooms'                  => $this->faker->numberBetween(1,20),
            'size_of_property'         => $this->faker->numberBetween(10000,500000),
            'payment'                  => $this->faker->numberBetween(50000,5000000),
            'start_down_payment'       => $this->faker->numberBetween(1,9999),
            'end_down_payment'         => $this->faker->numberBetween(9999,50000),
            'start_monthly_installment'=> $this->faker->numberBetween(1,9999),
            'end_monthly_installment'  => $this->faker->numberBetween(9999,100000),
            'start_payment_duration'   => $this->faker->numberBetween(1,9999),
            'end_payment_duration'     => $this->faker->numberBetween(9999,500000),
            'delivery_date'            => $this->faker->date('Y-m-d'),
            'image'                    => $this->faker->imageUrl($width = 200, $height = 200),
            'description'               => $this->faker->word,
        ];
    }
}

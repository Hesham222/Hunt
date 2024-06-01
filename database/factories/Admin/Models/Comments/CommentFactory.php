<?php

namespace Database\Factories\Admin\Models\Comments;
use Admin\Models\Comments\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'               => \Admin\Models\Posts\Post::factory(),
            // 'individual_id'          => \Admin\Models\Individual::factory(),
            'broker_id'              => \Admin\Models\Broker::factory(),
            // 'developer_id'           => \Admin\Models\Developer::factory(),
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

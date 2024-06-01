<?php

namespace Database\Factories\Admin\Models\Posts;
use Admin\Models\Posts\PostMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostMessage::class;

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
            'title'  => $this->faker->word,
            'message'=> $this->faker->word,
        ];
    }
}

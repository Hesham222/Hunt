<?php

namespace Database\Factories\Admin\Models\Reports;
use Admin\Models\Reports\PostReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostReport::class;

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
            'status'         => $this->faker->randomElement(['Pending','Dismissed']),
            'post_report_reason_id'         => $this->faker->numberBetween(1,9),
            'comments'  => $this->faker->word,
        ];
    }
}

<?php

namespace Database\Factories\Admin\Models\Reports;
use Admin\Models\Reports\AccountReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'individual_id'          => \Admin\Models\Individual::factory(),
            'broker_id'              => \Admin\Models\Broker::factory(),
            // 'developer_id'           => \Admin\Models\Developer::factory(),
             'reported_id'           => \Admin\Models\Individual::factory(),
            'status'         => $this->faker->randomElement(['Pending','Dismissed']),
            'account_report_reason_id'         => $this->faker->numberBetween(1,4),

            'comments'  => $this->faker->word,
        ];
    }
}

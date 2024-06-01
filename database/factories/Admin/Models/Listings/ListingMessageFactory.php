<?php

namespace Database\Factories\Admin\Models\Listings;
use Admin\Models\Listings\ListingMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListingMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'listing_id'               => \Admin\Models\Listings\Listing::factory(),
            // 'individual_id'          => \Admin\Models\Individual::factory(),
            'broker_id'              => \Admin\Models\Broker::factory(),
            // 'developer_id'           => \Admin\Models\Developer::factory(),
            'title'  => $this->faker->word,
            'message'=> $this->faker->word,
        ];
    }
}

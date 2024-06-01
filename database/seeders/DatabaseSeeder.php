<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(AdminSeeder::class);
       $this->call(CityTableSeeder::class);
       $this->call(ProfileColourSeeder::class);
       $this->call(PostReasonSeeder::class);
       $this->call(PostReasonOptionSeeder::class);
       $this->call(PostStatusSeeder::class);
       $this->call(PostSaleSeeder::class);
       $this->call(PostCompletionSeeder::class);
       $this->call(PostTypeSeeder::class);
       $this->call(ListingReasonSeeder::class);
       $this->call(ListingStatusSeeder::class);
       $this->call(ListingSaleSeeder::class);
       $this->call(ListingCompletionSeeder::class);
       $this->call(ListingTypeSeeder::class);
       //reports seeders
       $this->call(PostReportReasonSeeder::class);
       $this->call(AccountReportReasonSeeder::class);
       \Admin\Models\Area::factory()->count(50)->create();
       \Admin\Models\Developer::factory()->count(50)->create();
       \Admin\Models\Broker::factory()->count(50)->create();
       \Admin\Models\Individual::factory()->count(50)->create();
       \Admin\Models\Posts\Post::factory()->count(50)->create();
       \Admin\Models\Listings\Listing::factory()->count(50)->create();
       \Admin\Models\Comments\Comment::factory()->count(50)->create();
       \Admin\Models\Posts\PostMessage::factory()->count(50)->create();
       \Admin\Models\Listings\ListingMessage::factory()->count(50)->create();
       \Admin\Models\Reports\PostReport::factory()->count(50)->create();
       \Admin\Models\Reports\AccountReport::factory()->count(50)->create();
    }
}

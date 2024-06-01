<?php

use Illuminate\Database\Seeder;
use Admin\Models\Posts\PostReason;

class PostReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostReason::create([

            'en'   =>  [
                'reason' => 'Looking for renter',
            ],
            'ar'        =>  [
                'reason' => 'أبحث عن مستأجر',
            ],

        ]);
        PostReason::create([
            'en'   =>  [
                'reason' => 'Looking to rent',
            ],
            'ar'        =>  [
                'reason' => 'أبحث عن تأجير',
            ],
        ]);

        PostReason::create([
            'en'   =>  [
                'reason' => 'Looking to Sell',
            ],
            'ar'        =>  [
                'reason' => 'أبحث لكي ابيع',
            ],
        ]);

        PostReason::create([
            'en'   =>  [
                'reason' => 'Looking to Buy',
            ],
            'ar'        =>  [
                'reason' => 'أبحث لكي اشتري ',
            ],
        ]);
    }
}




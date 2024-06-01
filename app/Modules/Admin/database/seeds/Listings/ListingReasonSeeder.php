<?php

use Illuminate\Database\Seeder;
use Admin\Models\Listings\ListingReason;

class ListingReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListingReason::create([
            'en'   =>  [
                'reason' => 'Looking for renter',
            ],
            'ar'        =>  [
                'reason' => 'أبحث عن مستأجر',
            ],

        ]);
        ListingReason::create([
            'en'   =>  [
                'reason' => 'Looking to rent',
            ],
            'ar'        =>  [
                'reason' => 'أبحث عن تأجير',
            ],
        ]);

        ListingReason::create([
            'en'   =>  [
                'reason' => 'Looking to Sell',
            ],
            'ar'        =>  [
                'reason' => 'أبحث لكي ابيع',
            ],
        ]);
        
        ListingReason::create([
            'en'   =>  [
                'reason' => 'Looking to Buy',
            ],
            'ar'        =>  [
                'reason' => 'أبحث لكي اشتري ',
            ],
        ]);
    }
}




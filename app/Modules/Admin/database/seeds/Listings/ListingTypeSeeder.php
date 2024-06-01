<?php

use Illuminate\Database\Seeder;
use Admin\Models\Listings\ListingType;

class ListingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListingType::create([
            'en'   =>  [
                'type' => 'Villa',
            ],
            'ar'        =>  [
                'type' => 'فيلا',
            ],

        ]);
        ListingType::create([
            'en'   =>  [
                'type' => 'Twin House',
            ],
            'ar'        =>  [
                'type' => 'منزل مزدوج',
            ],
        ]);
        ListingType::create([
            'en'   =>  [
                'type' => 'Town House',
            ],
            'ar'        =>  [
                'type' => 'تاون هاوس',
            ],
        ]);
        ListingType::create([
            'en'   =>  [
                'type' => ' Duplex ',
            ],
            'ar'        =>  [
                'type' => '  مزدوج ',
            ],
        ]);
        ListingType::create([
            'en'   =>  [
                'type' => ' Apartment ',
            ],
            'ar'        =>  [
                'type' => ' شقه',
            ],
        ]);
        ListingType::create([
            'en'   =>  [
                'type' => 'Studio ',
            ],
            'ar'        =>  [
                'type' => ' ستوديو',
            ],
        ]);
    }
}




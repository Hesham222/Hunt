<?php

use Illuminate\Database\Seeder;
use Admin\Models\Listings\ListingStatus;

class ListingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListingStatus::create([
            'en'   =>  [
                'status' => 'Pending admin approval',
            ],
            'ar'        =>  [
                'status' => 'في انتظار المسؤول للموافقه',
            ],

        ]);
        ListingStatus::create([
            'en'   =>  [
                'status' => 'Available',
            ],
            'ar'        =>  [
                'status' => ' متاح',
            ],
        ]);
        ListingStatus::create([
            'en'   =>  [
                'status' => 'Unavailable',
            ],
            'ar'        =>  [
                'status' => ' غير متاح',
            ],
        ]);
    }
}




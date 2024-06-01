<?php

use Illuminate\Database\Seeder;
use Admin\Models\Listings\ListingSale;

class ListingSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListingSale::create([
            'en'   =>  [
                'sale' => 'Developer Sale',
            ],
            'ar'        =>  [
                'sale' => 'بيع المطور',
            ],

        ]);
        ListingSale::create([
            'en'   =>  [
                'sale' => 'Resale',
            ],
            'ar'        =>  [
                'sale' => 'اعاده بيع',
            ],
        ]);
        ListingSale::create([
            'en'   =>  [
                'sale' => 'Both',
            ],
            'ar'        =>  [
                'sale' => 'كلاهما',
            ],
        ]);
    }
}




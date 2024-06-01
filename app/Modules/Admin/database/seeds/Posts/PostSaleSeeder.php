<?php

use Illuminate\Database\Seeder;
use Admin\Models\Posts\PostSale;

class PostSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostSale::create([
            'en'   =>  [
                'sale' => 'Developer Sale',
            ],
            'ar'        =>  [
                'sale' => 'بيع المطور',
            ],

        ]);
        PostSale::create([
            'en'   =>  [
                'sale' => 'Resale',
            ],
            'ar'        =>  [
                'sale' => 'اعاده بيع',
            ],
        ]);
        PostSale::create([
            'en'   =>  [
                'sale' => 'Both',
            ],
            'ar'        =>  [
                'sale' => 'كلاهما',
            ],
        ]);
    }
}




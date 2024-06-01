<?php

use Illuminate\Database\Seeder;
use Admin\Models\Posts\PostType;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostType::create([
            'en'   =>  [
                'type' => 'Villa',
            ],
            'ar'        =>  [
                'type' => 'فيلا',
            ],

        ]);
        PostType::create([
            'en'   =>  [
                'type' => 'Twin House',
            ],
            'ar'        =>  [
                'type' => 'منزل مزدوج',
            ],
        ]);
        PostType::create([
            'en'   =>  [
                'type' => 'Town House',
            ],
            'ar'        =>  [
                'type' => 'تاون هاوس',
            ],
        ]);
        PostType::create([
            'en'   =>  [
                'type' => ' Duplex ',
            ],
            'ar'        =>  [
                'type' => '  مزدوج ',
            ],
        ]);
        PostType::create([
            'en'   =>  [
                'type' => ' Apartment ',
            ],
            'ar'        =>  [
                'type' => ' شقه',
            ],
        ]);
        PostType::create([
            'en'   =>  [
                'type' => 'Studio ',
            ],
            'ar'        =>  [
                'type' => ' ستوديو',
            ],
        ]);
    }
}




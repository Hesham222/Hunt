<?php

use Illuminate\Database\Seeder;
use Admin\Models\Listings\ListingCompletion;

class ListingCompletionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListingCompletion::create([
            'en'   =>  [
                'completion' => 'Unfinished',
            ],
            'ar'        =>  [
                'completion' => 'غير مجهز',
            ],

        ]);
        ListingCompletion::create([
            'en'   =>  [
                'completion' => 'Semi-finished',
            ],
            'ar'        =>  [
                'completion' => 'نصف مجهز',
            ],
        ]);
        ListingCompletion::create([
            'en'   =>  [
                'completion' => 'Finished',
            ],
            'ar'        =>  [
                'completion' => 'مجهز',
            ],
        ]);
        ListingCompletion::create([
            'en'   =>  [
                'completion' => 'Furnished',
            ],
            'ar'        =>  [
                'completion' => 'مفروشه',
            ],
        ]);
    }
}




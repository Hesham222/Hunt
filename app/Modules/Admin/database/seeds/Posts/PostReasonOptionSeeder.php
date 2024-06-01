<?php

use Illuminate\Database\Seeder;
use Admin\Models\Posts\PostReasonOption;

class PostReasonOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostReasonOption::create([
            'en'   =>  [
                'option' => 'Long Term',
            ],

            'ar'        =>  [
                'option' => 'طويل الأمد',
            ],

        ]);
        PostReasonOption::create([
            'en'   =>  [
                'option' => 'Short Term',
            ],

            'ar'        =>  [
                'option' => 'قصير الأمد',
            ],


        ]);
        PostReasonOption::create([

            'en'   =>  [
                'option' => 'Both',
            ],

            'ar'        =>  [
                'option' => 'كلاهما',
            ],

        ]);

    }
}



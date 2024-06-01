<?php

use Illuminate\Database\Seeder;
use Admin\Models\Posts\PostCompletion;

class PostCompletionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCompletion::create([
            'en'   =>  [
                'completion' => 'Unfinished',
            ],
            'ar'        =>  [
                'completion' => 'غير مجهز',
            ],

        ]);
        PostCompletion::create([
            'en'   =>  [
                'completion' => 'Semi-finished',
            ],
            'ar'        =>  [
                'completion' => 'نصف مجهز',
            ],
        ]);
        PostCompletion::create([
            'en'   =>  [
                'completion' => 'Finished',
            ],
            'ar'        =>  [
                'completion' => 'مجهز',
            ],
        ]);
        PostCompletion::create([
            'en'   =>  [
                'completion' => 'Furnished',
            ],
            'ar'        =>  [
                'completion' => 'مفروشه',
            ],
        ]);
    }
}




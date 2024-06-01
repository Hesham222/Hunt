<?php

use Illuminate\Database\Seeder;
use Admin\Models\Posts\PostStatus;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostStatus::create([
            'en'   =>  [
                'status' => 'Pending admin approval',
            ],
            'ar'        =>  [
                'status' => 'في انتظار المسؤول للموافقه',
            ],

        ]);
        PostStatus::create([
            'en'   =>  [
                'status' => 'Available',
            ],
            'ar'        =>  [
                'status' => ' متاح',
            ],
        ]);
        PostStatus::create([
            'en'   =>  [
                'status' => 'Unavailable',
            ],
            'ar'        =>  [
                'status' => ' غير متاح',
            ],
        ]);
    }
}




<?php

use Illuminate\Database\Seeder;
use Admin\Models\Reports\PostReportReason;

class PostReportReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostReportReason::create([
            'en'   =>  [
                'reason' => 'Spam',
            ],
            'ar'        =>  [
                'reason' => 'رسائل إلكترونية مزعجة',
            ],

        ]);

        PostReportReason::create([
            'en'   =>  [
                'reason' => 'Property not as described',
            ],
            'ar'        =>  [
                'reason' => 'الملكية ليست كما هو موصوف',
            ],

        ]);

        PostReportReason::create([
            'en'   =>  [
                'reason' => 'Nudity or sexual activity',
            ],
            'ar'        =>  [
                'reason' => 'العُري أو النشاط الجنسي',
            ],

        ]);
        PostReportReason::create([
            'en'   =>  [
                'reason' => ' Hate speech or symbols',
            ],
            'ar'        =>  [
                'reason' => 'الكلام الذي يحض على الكراهية أو الرموز',
            ],

        ]);
        PostReportReason::create([
            'en'   =>  [
                'reason' => ' False information',
            ],
            'ar'        =>  [
                'reason' => 'معلومات خاطئة',
            ],

        ]);
        PostReportReason::create([
            'en'   =>  [
                'reason' => ' Scam or fraud',
            ],
            'ar'        =>  [
                'reason' => 'النصب او الاحتيال',
            ],

        ]);

        PostReportReason::create([
            'en'   =>  [
                'reason' => ' Illegal sale',
            ],
            'ar'        =>  [
                'reason' => 'البيع غير القانوني',
            ],

        ]);


        PostReportReason::create([
            'en'   =>  [
                'reason' => ' Intellectual property violation',
            ],
            'ar'        =>  [
                'reason' => 'انتهاك حقوق الملكية الفكرية',
            ],

        ]);

        PostReportReason::create([
            'en'   =>  [
                'reason' => 'Other',
            ],
            'ar'        =>  [
                'reason' => 'سبب آخر',
            ],

        ]);
    }
}




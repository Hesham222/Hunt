<?php

use Illuminate\Database\Seeder;
use Admin\Models\Reports\AccountReportReason;

class AccountReportReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountReportReason::create([
            'en'   =>  [
                'reason' => 'Fake Account',
            ],
            'ar'        =>  [
                'reason' => 'حساب مزيف',
            ],

        ]);

        AccountReportReason::create([
            'en'   =>  [
                'reason' => 'Inappropriate behaviour related',
            ],
            'ar'        =>  [
                'reason' => 'متعلق بسلوك غير اللائق',
            ],

        ]);

        AccountReportReason::create([
            'en'   =>  [
                'reason' => 'Scam or fraud behaviour',
            ],
            'ar'        =>  [
                'reason' => 'سلوك احتيالي ',
            ],

        ]);

        AccountReportReason::create([
            'en'   =>  [
                'reason' => 'Other',
            ],
            'ar'        =>  [
                'reason' => 'سبب آخر',
            ],

        ]);

    }
}




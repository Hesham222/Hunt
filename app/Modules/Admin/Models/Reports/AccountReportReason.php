<?php

namespace Admin\Models\Reports;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AccountReportReason extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['reason'];

}

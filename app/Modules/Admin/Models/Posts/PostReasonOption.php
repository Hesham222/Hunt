<?php


namespace Admin\Models\Posts;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PostReasonOption extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['option'];
}

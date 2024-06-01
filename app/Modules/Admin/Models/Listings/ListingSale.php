<?php


namespace Admin\Models\Listings;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ListingSale extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['sale'];

}

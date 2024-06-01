<?php
namespace Admin\Models\Listings;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ListingType extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['type'];

}

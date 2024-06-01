<?php


namespace Admin\Models\Listings;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingCompletion extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['completion'];

}

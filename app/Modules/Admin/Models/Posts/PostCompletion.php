<?php


namespace Admin\Models\Posts;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCompletion extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['completion'];

}

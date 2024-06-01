<?php


namespace Admin\Models\Posts;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PostStatus extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['status'];

    public function color()
    {
        if($this->translate('en')->status == 'Pending admin approval')
            return 'blue';
        elseif($this->translate('en')->status == 'Available')
            return 'green';
        else
            return 'red';
    }
}

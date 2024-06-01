<?php


namespace Admin\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'created_by')->withTrashed();
    }

    public function areas()
    {
        return $this->hasMany(Area::class, 'city_id');
    }

    public function areasOnlyTrashed()
    {
        return $this->hasMany(Area::class, 'city_id')->onlyTrashed();
    }

    public function areasWithTrashed()
    {
        return $this->hasMany(Area::class, 'city_id')->withTrashed();
    }

}

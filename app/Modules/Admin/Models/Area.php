<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name'];

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'created_by')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function cityWithTrashed()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }
}

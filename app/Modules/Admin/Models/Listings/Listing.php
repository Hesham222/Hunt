<?php


namespace Admin\Models\Listings;

use App\Modules\Admin\Models\Listings\ListingFavourite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Admin\Models\{
    Broker,
    Developer,
    City,
    Area,
};
use User\Models\PostImage;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function reason()
    {
        return $this->belongsTo(ListingReason::class, 'listing_reason_id');
    }
    public function messages()
    {
        return $this->hasMany(ListingMessage::class, 'listing_id');
    }
    public function images()
    {
        return $this->hasMany(PostImage::class, 'model_id');
    }
    public function broker()
    {
        return $this->belongsTo('Admin\Models\Broker', 'broker_id');
    }

    public function getDeveloper()
    {
        return $this->belongsTo('Admin\Models\Developer', 'developer_id');
    }

    public function user()
    {
        if($this->broker_id)
            return $this->broker;
        else
            return $this->getDeveloper;
    }

    public function createdUsers()
    {
        if($this->broker_id)
            return 'Brokers';
        else
            return 'Developers';
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function type()
    {
        return $this->belongsTo(ListingType::class, 'listing_type_id');
    }

    public function sale()
    {
        return $this->belongsTo(ListingSale::class, 'listing_sale_id');
    }

    public function completion()
    {
        return $this->belongsTo(ListingCompletion::class, 'listing_completion_id');
    }

    public function status()
    {
        return $this->belongsTo(ListingStatus::class, 'listing_status_id');
    }
    public function favourite(){

        $userId = auth('individualApi')->user()!=null? auth('individualApi')->user()->id :null;
        return $this->belongsTo(ListingFavourite::class,'id','listing_id')->where('individual_id',$userId);
    }
    public function getCompound()
    {
        return $this ->in_a_compound == 0 ? 'No'  : 'Yes' ;
    }

    public function checkPost(){

        foreach ($this->images as $image){
            if ($image->model_type == 'Post'){
                return 'Post';
            }else{
                return 'Listing';
            }
        }
    }

}

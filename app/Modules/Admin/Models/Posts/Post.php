<?php


namespace Admin\Models\Posts;
use Admin\Models\Listings\ListingMessage;
use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Admin\Models\Comments\Comment;
use Admin\Models\{
    Individual,
    City,
    Area,
};
use User\Models\PostImage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function images()
    {
        return $this->hasMany(PostImage::class, 'model_id');
    }
    public function postMessages()
    {
        return $this->hasMany(PostMessage::class, 'post_id');
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

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function reason()
    {
        return $this->belongsTo(PostReason::class, 'post_reason_id');
    }

    public function reasonOption()
    {
        return $this->belongsTo(PostReasonOption::class, 'post_reason_option_id');
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
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function sale()
    {
        return $this->belongsTo(PostSale::class, 'post_sale_id');
    }

    public function completion()
    {
        return $this->belongsTo(PostCompletion::class, 'post_completion_id');
    }

    public function status()
    {
        return $this->belongsTo(PostStatus::class, 'post_status_id');
    }

    public function favourite(){

        $userId = auth('individualApi')->user()!=null? auth('individualApi')->user()->id :null;
        return $this->belongsTo(PostFavourite::class,'id','post_id')->where('individual_id',$userId);
    }

    public function getCompound()
    {
        return $this->in_a_compound == '1' ? 'Yes'  : 'No' ;
    }


}

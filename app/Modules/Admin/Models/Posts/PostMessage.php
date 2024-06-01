<?php


namespace Admin\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use User\Models\BrokerReplayMessage;
use User\Models\DeveloperReplayMessage;
use User\Models\IndividualReplayMessage;
use User\Models\SendImage;

class PostMessage extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(SendImage::class, 'model_id');
    }
    public function checkImage(){

        foreach ($this->images as $image){
            if ($image->model_type == 'PostMessage'){
                return 'post';
            }elseif ($image->model_type == 'ListingMessage'){
                return 'listing';
            }
        }
    }

    public function postMessage()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function senders()
    {
        if($this->broker_id)
            return 'Brokers';
        if($this->individual_id)
            return 'Individuals';
        else
            return 'Developers';
    }

    public function sender()
    {
        if($this->broker_id)
            return $this->broker;
        if($this->individual_id)
            return $this->individual;
        else
            return $this->developer;
    }
    public function broker()
    {
        return $this->belongsTo('Admin\Models\Broker', 'broker_id');
    }

    public function developer()
    {
        return $this->belongsTo('Admin\Models\Developer', 'developer_id');
    }
    public function individual()
    {
        return $this->belongsTo('Admin\Models\Individual', 'individual_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function individualReplies()
    {
        return $this->hasMany(IndividualReplayMessage::class, 'post_message_id');
    }

    public function brokerReplies()
    {
        return $this->hasMany(BrokerReplayMessage::class, 'post_message_id');
    }

    public function developerReplies()
    {
        return $this->hasMany(DeveloperReplayMessage::class, 'post_message_id');
    }

}

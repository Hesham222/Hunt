<?php


namespace Admin\Models\Comments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Admin\Models\Posts\{
    Post,
    PostCompletion,
    PostStatus
};
class Comment extends Model
{
    use HasFactory;

    public function broker()
    {
        return $this->belongsTo('Admin\Models\Broker', 'broker_id');
    }
    public function getDeveloper()
    {
        return $this->belongsTo('Admin\Models\Developer', 'developer_id');
    }
    public function developer()
    {
        return $this->belongsTo('Admin\Models\Developer', 'developer_id');
    }
    public function individual()
    {
        return $this->belongsTo('Admin\Models\Individual', 'individual_id');
    }

    public function user()
    {
        if($this->broker_id)
            return $this->broker;
        if($this->individual_id)
            return $this->individual;
        else
            return $this->developer;
    }

    public function createdUsers()
    {
        if($this->broker_id)
            return 'Brokers';
        if($this->individual_id)
            return 'Individuals';
        else
            return 'Developers';
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function completion()
    {
        return $this->belongsTo(PostCompletion::class, 'post_completion_id');
    }

    public function status()
    {
        return $this->belongsTo(PostStatus::class, 'post_status_id');
    }
}

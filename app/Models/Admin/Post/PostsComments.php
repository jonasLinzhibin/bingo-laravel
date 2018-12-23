<?php

namespace App\Models\Admin\Post;

use Illuminate\Database\Eloquent\Model;

class PostsComments extends Model
{
    protected $table = 'posts_comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','post_id','user_id'
    ];

    public function post() {
        return $this->belongsTo('App\Models\Admin\Post\Posts');
    }
}

<?php

namespace App\Models\Admin\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','content'
    ];

    public function comments() {
        return $this->hasMany('App\Models\Admin\Post\PostsComments','post_id');
    }
}

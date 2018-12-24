<?php

namespace App\Models\Post;

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
        'category_id','author_id','title','content','thumb','tags','sort','audit','status','is_top','recommended','seo_title','seo_keywords','seo_description',
    ];

    public function comments() {
        return $this->hasMany('App\Models\Admin\Post\PostsComments','post_id');
    }
}

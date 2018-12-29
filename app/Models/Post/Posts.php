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
        return $this->hasMany('App\Models\Post\PostsComments','post_id');
    }

    /**
     * 获得此文章下所有的标签。
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Post\PostsTags', 'posts_has_tags', 'post_id', 'tag_id');
    }

    public function counts(){
        return $this->where('status',1)->count();
    }

}

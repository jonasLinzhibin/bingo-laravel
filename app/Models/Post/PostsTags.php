<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostsTags extends Model
{
    protected $table='posts_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','category_id','clicks','status','sort'
    ];
    /**
     * 获得此标签下所有的文章。
     */
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post\PostsTags', 'posts_has_tags', 'tag_id', 'post_id');
    }

}

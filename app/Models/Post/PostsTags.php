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
}

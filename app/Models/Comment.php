<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','blog_id','user_id'
    ];

    public function blog() {
        return $this->belongsTo('App\Models\Blog');
    }
}

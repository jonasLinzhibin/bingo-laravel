<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','content'
    ];

    public function comments() {
        return $this->hasMany('App\Models\Comment','blog_id');
    }
}

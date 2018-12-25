<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostsHasTags extends Pivot
{
    public $table='posts_has_tags';


}

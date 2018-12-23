<?php

namespace App\Models\Admin\Post;

use Illuminate\Database\Eloquent\Model;

class PostsConfigs extends Model
{
    protected $table='posts_configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'need_audit','allow_comment', 'post_type', 'post_name', 'sort'
    ];


    public static function getConfigs(){
        $list = self::orderBy('sort','asc')->get()->toArray();

        $configs = [];
        $configs['data'] = [];
        foreach ($list as $key => $item) {
            $configs['data'][] = $item;
            $configs[$item['id']] = $item['post_type'];
        }
        return $configs;

    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public $table='attachment';

    protected $fillable = [
        'uid','name','path','disk','ext','mime_type','size','md5','download','status',
    ];

    static function getInfo($id)
    {
        return self::where('id','=',$id)->get();
    }

    static function getPath($id)
    {
        $info = self::getInfo($id);
        return $info && isset($info[0]) ? $info[0]['path'] : '';
    }

    static function isExist($md5)
    {
        $info = self::where('md5','=',$md5)->get();
        return $info && isset($info[0]) ? $info[0] : 0;
    }
}

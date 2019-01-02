<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\Media;
use Auth;

class Admin extends Authenticatable implements HasMedia
{

    use Notifiable;
    use HasRoles;
    use HasMediaTrait;

    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    static function hasRoles()
    {

        $admin = Auth::guard('admin')->user();
        $roles =  $admin->getRoleNames();

        $data = (object)array();
        if($roles){
            foreach ($roles as $name){
                $role = Role::findByName($name,'admin');
                $data->ids[] = $role->id;
                $data->roles[$role->id] = $role;
            }
        }

        return $data;

    }

    public function counts(){
        return $this->where('status',1)->count();
    }

}

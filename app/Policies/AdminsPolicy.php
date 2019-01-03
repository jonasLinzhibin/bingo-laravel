<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function update(Admin $admin, Admin $model)
    { 
        return $admin->is_super || $admin->id == $model->id;
    }
}

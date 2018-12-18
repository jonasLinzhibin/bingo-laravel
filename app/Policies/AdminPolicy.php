<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return mixed
     */
    public function view(Admin $admin, Admin $model)
    {
        //
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return mixed
     */
    public function update(Admin $admin, Admin $model)
    {
        return $admin->id == $model->id;
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return mixed
     */
    public function delete(Admin $admin, Admin $model)
    {
        return $admin->is_super && $admin->id != $model->id;
    }
}

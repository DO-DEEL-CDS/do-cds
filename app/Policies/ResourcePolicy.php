<?php

namespace App\Policies;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Resource  $resource
     * @return Response|bool
     */
    public function view(User $user, Resource $resource)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Resource  $resource
     * @return Response|bool
     */
    public function update(User $user, Resource $resource)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Resource  $resource
     * @return Response|bool
     */
    public function delete(User $user, Resource $resource)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Resource  $resource
     * @return Response|bool
     */
    public function restore(User $user, Resource $resource)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Resource  $resource
     * @return Response|bool
     */
    public function forceDelete(User $user, Resource $resource)
    {
        return $user->hasRole('admin');
    }
}

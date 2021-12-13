<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
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
        return $user->can('access-projects') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return Response|bool
     */
    public function view(User $user, Project $project)
    {
        return $user->can('access-projects') || $user->hasRole('admin');
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
     * @param  Project  $project
     * @return Response|bool
     */
    public function update(User $user, Project $project)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return Response|bool
     */
    public function delete(User $user, Project $project)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return Response|bool
     */
    public function restore(User $user, Project $project)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return Response|bool
     */
    public function forceDelete(User $user, Project $project)
    {
        return $user->hasRole('super-admin');
    }

}

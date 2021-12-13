<?php

namespace App\Policies;

use App\Models\GmbSubmission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GmbSubmissionPolicy
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
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  GmbSubmission  $business
     * @return Response|bool
     */
    public function view(User $user, GmbSubmission $business)
    {
        return $business->user_id === $user->id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('corper');
    }

    /**
     * Determine whether the user can import models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function import(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  GmbSubmission  $business
     * @return Response|bool
     */
    public function update(User $user, GmbSubmission $business)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  GmbSubmission  $business
     * @return Response|bool
     */
    public function delete(User $user, GmbSubmission $business)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  GmbSubmission  $business
     * @return Response|bool
     */
    public function restore(User $user, GmbSubmission $business)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  GmbSubmission  $business
     * @return Response|bool
     */
    public function forceDelete(User $user, GmbSubmission $business)
    {
        return $user->hasRole('admin');
    }
}

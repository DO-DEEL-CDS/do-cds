<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AnnouncementPolicy
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
     * @param  Announcement  $announcement
     * @return Response|bool
     */
    public function view(User $user, Announcement $announcement)
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
     * @param  Announcement  $announcement
     * @return Response|bool
     */
    public function update(User $user, Announcement $announcement)
    {
        return $announcement->author_id === $user->id || $user->hasRole('aadmin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return Response|bool
     */
    public function delete(User $user, Announcement $announcement)
    {
        return $announcement->author_id === $user->id || $user->hasRole('aadmin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return Response|bool
     */
    public function restore(User $user, Announcement $announcement)
    {
        return $announcement->author_id === $user->id || $user->hasRole('aadmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return Response|bool
     */
    public function forceDelete(User $user, Announcement $announcement)
    {
        return $user->hasRole('super-admin');
    }
}

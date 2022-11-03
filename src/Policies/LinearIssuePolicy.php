<?php

namespace LaravelNovaLinear\Policies;

use LaravelNovaLinear\Models\LinearIssue;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinearIssuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\LinearIssue  $linearIssue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, LinearIssue $linearIssue)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\LinearIssue  $linearIssue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, LinearIssue $linearIssue)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\LinearIssue  $linearIssue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, LinearIssue $linearIssue)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\LinearIssue  $linearIssue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, LinearIssue $linearIssue)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\LinearIssue  $linearIssue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, LinearIssue $linearIssue)
    {
        return true;
    }
}

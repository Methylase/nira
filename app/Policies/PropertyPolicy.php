<?php

namespace App\Policies;

use App\Property;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function view(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return $user->id === $property->user_id ? Response::allow()
        : Response::deny('You are not allowed to update this property.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
        return $user->roles[0]->name == "ROLE_ADMIN"              
        ? Response::allow()
        : Response::deny('You are not allowed to delete this property.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function restore(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function forceDelete(User $user, Property $property)
    {
        //
    }
}

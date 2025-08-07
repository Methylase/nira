<?php

namespace App\Policies;

use App\Blog;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
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
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function view(User $user, Blog $blog)
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
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function update(User $user, Blog $blog)
    {
        return ($user->roles[0]->name == "ROLE_ADMIN" && $user->id === $blog->user_id) ? Response::allow()
        : Response::deny('You are not allowed to update this property.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function delete(User $user, Blog $blog)
    {
        return $user->roles[0]->name == "ROLE_ADMIN"              
        ? Response::allow()
        : Response::deny('You are not allowed to delete this blog post');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function restore(User $user, Blog $blog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function forceDelete(User $user, Blog $blog)
    {
        //
    }
}

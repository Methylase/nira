<?php

namespace App\Policies;

use App\User;
use App\Profile;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     *@param  \App\Profile  $profile
     * @return mixed
     */
   /* function  view(User $user, Profile $profile){
        return $user->roles[0]->name == "ROLE_ADMIN"              
        ? Response::allow()
        : Response::deny('You do not own this profile.');
    }*/ 
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    function  create(User $user){
        return $user->roles[0]->name == "ROLE_ADMIN"              
        ? Response::allow()
        : Response::deny('You do not own this profile.');
    }
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     *@param  \App\Profile  $profile
     * @return mixed
     */
    function  update(User $user, Profile $profile){
        return $user->roles[0]->name == "ROLE_ADMIN"              
        ? Response::allow()
        : Response::deny('You do not own this profile.');
    }
}
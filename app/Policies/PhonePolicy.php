<?php

namespace App\Policies;

use App\Phone;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any phones.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the phone.
     *
     * @param  \App\User  $user
     * @param  \App\Phone  $phone
     * @return mixed
     */
    public function view(User $user, Phone $phone)
    {
        //
    }

    /**
     * Determine whether the user can create phones.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the phone.
     *
     * @param  \App\User  $user
     * @param  \App\Phone  $phone
     * @return mixed
     */
    public function update(User $user, Phone $phone)
    {
        if (
            $user->can('Editar Telefones') &&
            array_intersect($phone->clients[0]->user->getRoleNames()->toArray(), $user->getRoleNames()->toArray())
        ) {
            return true;
        }
        return $user->id == $phone->clients[0]->user_id;
    }

    /**
     * Determine whether the user can delete the phone.
     *
     * @param  \App\User  $user
     * @param  \App\Phone  $phone
     * @return mixed
     */
    public function delete(User $user, Phone $phone)
    {
        if (
            $user->can('Excluir Telefone') &&
            array_intersect($phone->clients[0]->user->getRoleNames()->toArray(), $user->getRoleNames()->toArray())
        ) {
            return true;
        }
        return $user->id == $phone->clients[0]->user_id;
    }

    /**
     * Determine whether the user can restore the phone.
     *
     * @param  \App\User  $user
     * @param  \App\Phone  $phone
     * @return mixed
     */
    public function restore(User $user, Phone $phone)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the phone.
     *
     * @param  \App\User  $user
     * @param  \App\Phone  $phone
     * @return mixed
     */
    public function forceDelete(User $user, Phone $phone)
    {
        //
    }
}

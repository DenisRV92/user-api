<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function store(User $user)
    {
        return $user->getRole->name === 'user';
    }

    public function index(User $user)
    {
        return $user->getRole->name === 'manager';
    }

    public function update(User $user)
    {
        return $user->getRole->name === 'manager';
    }
}

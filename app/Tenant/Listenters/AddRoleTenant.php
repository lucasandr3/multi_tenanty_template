<?php

namespace App\Tenant\Listenters;

use App\Models\Role;

class AddRoleTenant
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user();

        if (!$role = Role::query()->first()) {
            return;
        }

        $user->roles()->attach($role);
    }
}

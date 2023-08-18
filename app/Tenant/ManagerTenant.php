<?php

namespace App\Tenant;

use App\Models\Tenant\Tenant;

class ManagerTenant
{
    /**
     * @return int|null
     */
    public function getTenantIdentify(): ?int
    {
        return !empty(auth()->user()->tenant_id) ? auth()->user()->tenant_id : null;
    }

    /**
     * @return Tenant|null
     */
    public function getTenant(): ?Tenant
    {
        return !empty(auth()->user()->tenant) ? auth()->user()->tenant : null;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        $userEmail = !empty(auth()->user()->email) ? auth()->user()->email : null;

        if ($userEmail) {
            return in_array($userEmail, config('tenant.admins'), true);
        }

        return false;
    }
}

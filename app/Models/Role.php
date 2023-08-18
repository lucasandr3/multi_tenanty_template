<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionsAvailable($filter = null, $offset, $limit)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            })
            ->skip($offset)->take($limit)->get();

        return $permissions;
    }

    public function permissionsAvailableCount($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            })
            ->get()->count();

        return $permissions;
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

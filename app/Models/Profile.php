<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions($filters)
    {
        return $this->belongsToMany(Permission::class)
            ->when(!empty($filters['term']), function ($query) use ($filters) {
                $query->where('permissions.name', 'LIKE', "%{$filters['term']}%");
            })
            ->paginate(10);
    }

    public function permissionsSeed(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_profiles');
    }

    public function permissionsAvailable($filter = null, $offset, $limit)
    {
        $permissions = Permission::whereNotIn('id', function ($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("profile_id={$this->id}");
        })->where(function ($queryFilter) use ($filter) {
            if($filter) {
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            }
        })->skip($offset)->take($limit)->get();

        return $permissions;
    }

    public function permissionsAvailableCount($filter = null)
    {
        $permissions = Permission::whereNotIn('id', function ($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("profile_id={$this->id}");
        })->where(function ($queryFilter) use ($filter) {
            if($filter) {
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            }
        })->get()->count();

        return $permissions;
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}

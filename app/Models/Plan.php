<?php

namespace App\Models;

use App\Models\Tenant\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'price', 'description'];

    public function search($filter = null)
    {
        return $this->where('name', 'LIKE', "%{$filter}%")->orWhere('name', 'LIKE', "%{$filter}%")->latest()->paginate(1);
    }

    public function details(): HasMany
    {
        return $this->hasMany(PlanDetails::class);
    }

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'plan_profiles');
    }

    public function profilesAvailable($filter = null)
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query) {
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $profiles;
    }

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }
}

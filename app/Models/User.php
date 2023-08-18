<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Tenant\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d h:i:s'
    ];

    public function scopeTenantUser(Builder $builder)
    {
        return $builder->where('tenant_id', auth()->user()->tenant_id);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function roles($filters)
    {
        return $this->belongsToMany(Role::class)
            ->when(!empty($filters['term']), function ($query) use ($filters) {
                $query->where('roles.name', 'LIKE', "%{$filters['term']}%");
            })
            ->paginate(10);
    }

    public function myRoles()
    {
        return $this->belongsToMany(Role::class)->get();
    }

//    public function notifications()
//    {
//        return $this->hasMany(Notification::class, 'agent_id')->where('bol_read', false);
//    }

    public function rolesAvailable($filters)
    {
        $roles = Role::whereNotIn('roles.id', function($query) {
            $query->select('role_user.role_id');
            $query->from('role_user');
            $query->whereRaw("role_user.user_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filters) {
                if (!empty($filters['term']))
                    $queryFilter->where('roles.name', 'LIKE', "%{$filters['term']}%");
            })
            ->paginate(10);

        return $roles;
    }
}

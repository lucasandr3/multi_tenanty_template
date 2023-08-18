<?php

namespace App\Models\Tenant;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'document',
        'name',
        'url',
        'email',
        'logo',
        'bol_active',
        'subscription',
        'expires_at',
        'subscription_id',
        'subscription_active',
        'subscription_suspended',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function address()
    {
        return $this->hasMany(TenantAddress::class, 'tenant_id')->get()->first();
    }
}

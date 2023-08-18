<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenantAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'zipcode',
        'street',
        'city',
        'uf',
        'neighborhood',
        'number',
        'complement'
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}

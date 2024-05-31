<?php

namespace App\Models;

use App\Models\House;
use App\Models\Payment;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    protected $fillable =
    [
        'name',
        'start_date',
        'house_id',
        'balance',
    ];

    use HasFactory;

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeOwned(Builder $query, $tenantId)
    {
        $query->where('tenant_id', $tenantId);
    }
}

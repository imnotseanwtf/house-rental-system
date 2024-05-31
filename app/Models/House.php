<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\HouseType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class House extends Model
{
    protected $fillable =
    [
        'house_number',
        'house_type_id',
        'description',
        'price',
    ];

    use HasFactory;

    public function houseType(): BelongsTo
    {
        return $this->belongsTo(HouseType::class);
    }

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HouseType extends Model
{
    protected $fillable =
    [
        'category'
    ];

    use HasFactory;

    public function houses(): HasMany
    {
        return $this->hasMany(House::class);
    }
}

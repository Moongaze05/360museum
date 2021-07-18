<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string title
 * @property string panorama
 */
class Scene extends Model
{
    use HasFactory;

    public function museum(): BelongsTo
    {
        return $this->belongsTo(related: Museum::class);
    }

    public function hotspots(): HasMany
    {
        return $this->hasMany(related: Hotspot::class);
    }
}

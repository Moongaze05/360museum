<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string title
 * @property string panorama
 * @property Collection hotspots
 * @property Museum museum
 * @property double map_x
 * @property double map_y
 * @property Group group
 */
class Scene extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function museum(): BelongsTo
    {
        return $this->belongsTo(related: Museum::class);
    }

    public function hotspots(): HasMany
    {
        return $this->hasMany(related: Hotspot::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(related: Group::class);
    }
}

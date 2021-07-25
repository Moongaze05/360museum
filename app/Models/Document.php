<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

/**
 * @property Collection hotspots
 * @property null|string description
 */
class Document extends Model
{
    use AsSource;
    use HasFactory;

    protected $guarded = [];

    public function hotspots(): HasMany
    {
        return $this->hasMany(related: Hotspot::class);
    }
}

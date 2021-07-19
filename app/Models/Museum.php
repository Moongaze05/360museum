<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property null|string title
 * @property string preview
 * @property string logo
 * @property string map
 * @property Collection scenes
 */
class Museum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'title';
    }

    public function scenes(): HasMany
    {
        return $this->hasMany(Scene::class);
    }
}

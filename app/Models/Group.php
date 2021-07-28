<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property null|string title
 * @property null|string default_scene
 * @property null|int order
 * @property Collection scenes
 */
class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scenes(): HasMany
    {
        return $this->hasMany(related: Scene::class);
    }
}

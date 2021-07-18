<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string title
 * @property string type
 * @property double pitch
 * @property double yaw
 */
class Hotspot extends Model
{
    use HasFactory;

    public function document(): HasOne
    {
        return $this->hasOne(related: Document::class);
    }

    public function target(): HasOne
    {
        return $this->hasOne(related: Scene::class, localKey: 'pointer_target');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title
 * @property string type
 * @property double pitch
 * @property double yaw
 * @property Scene target
 * @property Document document
 * @property Scene scene
 */
class Hotspot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function document(): BelongsTo
    {
        return $this->belongsTo(related: Document::class);
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(related: Scene::class, foreignKey: 'pointer_target');
    }

    public function scene(): BelongsTo
    {
        return $this->belongsTo(related: Scene::class);
    }
}

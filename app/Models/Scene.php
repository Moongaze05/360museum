<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title
 * @property string panorama
 */
class Scene extends Model
{
    use HasFactory;

    public function museum(): BelongsTo
    {
        return $this->belongsTo(Museum::class);
    }
}

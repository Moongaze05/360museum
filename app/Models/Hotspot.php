<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property string type
 * @property double pitch
 * @property double yaw
 */
class Hotspot extends Model
{
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property null|string title
 * @property string preview
 * @property string logo
 */
class Museum extends Model
{
    use HasFactory;
}

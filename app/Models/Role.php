<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    /**
     * Manthabill v.2.0
     * Date: 18-12-2021
     * Author:AlexisDev
     * Email: alexistdev@gmail.com
     * Phone: 0813-7982-3241
     */

    use HasFactory,HasApiTokens;
    protected $fillable = [
        'name',
    ];

}

<?php

// app/Models/Log.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['level', 'message', 'context'];

    // If using JSON casting for the context field
    protected $casts = [
        'context' => 'array',
    ];
}

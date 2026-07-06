<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrashScan extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'object_name',
        'category',
        'score',
        'thumbnail',
        'is_permanent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

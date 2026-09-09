<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritingProgress extends Model
{
    protected $fillable = [
        'user_id',
        'lesson',
        'completed',
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritingLesson extends Model
{
    protected $fillable = [
        'numero',
        'titulo',
        'instrucao',
        'xp',
    ];

    public function questions()
    {
        return $this->hasMany(WritingQuestion::class);
    }
}

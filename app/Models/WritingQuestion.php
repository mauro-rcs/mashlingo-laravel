<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritingQuestion extends Model
{
    protected $fillable = [
        'writing_lesson_id',
        'ordem',
        'frase_portugues',
        'resposta_correta',
    ];

    public function lesson()
    {
        return $this->belongsTo(WritingLesson::class, 'writing_lesson_id');
    }
}

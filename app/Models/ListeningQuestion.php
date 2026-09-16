<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListeningQuestion extends Model
{
    protected $fillable = [
        'listening_lesson_id', // Add esta linha aqui!
        'ordem',
        'audio',
        'pergunta',
        'resposta_1',
        'resposta_2',
        'resposta_3',
        'resposta_4',
        'resposta_correta',
    ];

    public function lesson()
    {
        return $this->belongsTo(ListeningLesson::class, 'listening_lesson_id');
    }
}

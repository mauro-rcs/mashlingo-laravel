<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListeningLesson extends Model
{
    protected $fillable = [
        'numero',
        'titulo',
        'instrucao',
        'xp',
        'categoria',
        'nivel'
    ];

    public function questions()
    {
        return $this->hasMany(ListeningQuestion::class)
            ->orderBy('ordem');
    }
}

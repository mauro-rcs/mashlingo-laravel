<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XpLog extends Model
{
    protected $fillable = ['user_id', 'tipo', 'lesson_id', 'xp'];
}

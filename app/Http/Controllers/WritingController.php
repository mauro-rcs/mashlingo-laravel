<?php

namespace App\Http\Controllers;

use App\Models\WritingLesson;

class WritingController extends Controller
{
    public function show(WritingLesson $lesson)
    {
        $lesson->load('questions');

        return view('escrita.lesson', compact('lesson'));
    }
}

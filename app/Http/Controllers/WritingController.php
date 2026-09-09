<?php

namespace App\Http\Controllers;

use App\Models\WritingLesson;
use Illuminate\Http\Request;

class WritingController extends Controller
{
    //
    public function show(WritingLesson $lesson)
    {
        $lesson->load('questions');
        return view('escrita.lesson', compact('lesson'));
    }
}
